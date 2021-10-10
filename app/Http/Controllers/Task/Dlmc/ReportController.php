<?php

namespace App\Http\Controllers\Task\Dlmc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Task\Dlmc\DlmcApplication;
use Maatwebsite\Excel\Facades\Excel;

use App\Reports\Dlmc\ApplicationReport as ExportApplicationReport;
use App\Reports\Dlmc\BudgetReport as ExportBudgetReport;

class ReportController extends Controller
{
    public function applicationReport()
    {

        $lists = DlmcApplication::whereHas('dlmcActionRecord', function($q){
            return $q->submittedAt(request('submitted_at'))
              ->resubmittedAt(request('resubmitted_at'))
              ->incompleteAt(request('incomplete_at'))
              ->autoCancelledAt(request('auto_cancelled_at'))
              ->rejectedAt(request('rejcted_at'))
              ->approvedAt(request('approved_at'));
        })
        ->whereNotIn('application_status', ['draft', 'trash'])
        ->applicationStatus(request('application_status'))
        ->certificateNo(request('certificate_no'))
        ->applicationNo(request('application_no'))
        ->manufName(request('manufacturer_name'))
        ->applicationType(request('application_type'))
        ->issuedAt(request('issued_at'))
        ->expiredAt(request('expire_at'))
        ->whereHas('dlmcDrugsToProduce', function ($qry) {
            $qry->dosageType(request('dosage_type'));
        })
        ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
        ->paginate(request('ipp', 25));

        if( request('action') === 'report' ) {
            return Excel::download(new ExportApplicationReport($lists), 'DLMC-Application-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.dlmc.application-report');
        }
    }

    public function financeReport()
    {
        $lists = DlmcApplication::whereHas('dlmcActionRecord', function($q){
            return $q->paidAt(request('paid_at'));
        })
        ->whereNotIn('application_status', ['draft', 'trash'])
        ->certificateNo(request('certificate_no'))
        ->applicationNo(request('application_no'))
        ->manufName(request('manufacturer_name'))
        ->applicationType(request('application_type'))
        ->whereHas('dlmcDrugsToProduce', function ($qry) {
            $qry->dosageType(request('dosage_type'));
        })
        ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
        ->paginate(request('ipp', 25));

        if( request('action') === 'report' ) {
            return Excel::download(new ExportBudgetReport($lists), 'DLMC-Budget-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.dlmc.budget-report');
        }
    }


}
