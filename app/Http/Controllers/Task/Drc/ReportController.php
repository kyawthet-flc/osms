<?php

namespace App\Http\Controllers\Task\Drc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Task\Drc\DrcApplication;

use App\Reports\Drc\ApplicationReport as ExportApplicationReport;
use App\Reports\Drc\BudgetReport as ExportBudgetReport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    protected $applicationModuleId = 2;
    public function applicationReport()
    {
        $lists = DrcApplication::whereHas('drcActionRecord', function($q){
            return $q->submittedAt(request('submitted_at'))
                ->resubmittedAt(request('resubmitted_at'))
                ->incompleteAt(request('incomplete_at'))
                ->autoCancelledAt(request('auto_cancelled_at'))
                ->rejectedAt(request('rejected_at'))
                ->approvedAt(request('approved_at'));
        })
            ->whereApplicationModuleId($this->applicationModuleId)
            ->whereNotIn('application_status', ['draft', 'trash'])
            ->applicationStatus(request('application_status'))
            ->certificateNo(request('certificate_no'))
            ->applicationNo(request('application_no'))
            ->applicationType(request('application_type'))
            ->issuedAt(request('issued_at'))
            ->expiredAt(request('expire_at'))
            ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
            ->paginate(request('ipp', 25));

        if( request('action') === 'report' ) {
            return Excel::download(new \App\Reports\Drc\ApplicationReport($lists), 'DRC(import)-Application-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.drc.application-report');
        }
    }

    public function budgetReport()
    {
        $lists = DrcApplication::whereHas('drcActionRecord', function($q){
            return $q->paidAt(request('paid_at'));
        })
            ->whereApplicationModuleId($this->applicationModuleId)
            ->whereNotIn('application_status', ['draft', 'trash'])
            ->certificateNo(request('certificate_no'))
            ->applicationNo(request('application_no'))
            ->applicationType(request('application_type'))
            ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
            // ->toSql();
            // dd($lists);
            ->paginate(request('ipp', 25));

        if( request('action') === 'report' ) {
            return Excel::download(new ExportBudgetReport($lists), 'DRC(import)-Budget-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.drc.budget-report');
        }

    }
}
