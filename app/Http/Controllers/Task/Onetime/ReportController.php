<?php

namespace App\Http\Controllers\Task\Onetime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Task\Onetime\OnetimeApplication;

use Maatwebsite\Excel\Facades\Excel;

use App\Reports\Onetime\ApplicationReport as ExportApplicationReport;
use App\Reports\Onetime\BudgetReport as ExportBudgetReport;

class ReportController extends Controller
{
    
    public function applicationReport()
    {
        $lists = OnetimeApplication::whereHas('onetimeActionRecord', function($q){
            return $q->submittedAt(request('submitted_at'))
              ->resubmittedAt(request('resubmitted_at'))
              ->incompleteAt(request('incomplete_at'))
              ->autoCancelledAt(request('auto_cancelled_at'))
              ->rejectedAt(request('rejcted_at'))
              ->approvedAt(request('approved_at'));
        })->whereHas('onetimeProductLists', function($q){
            return $q->where('drug_name', 'like', '%'.request('drug_name').'%')
                        ->where('brand_name', 'like', '%'.request('brand_name').'%');
        })
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
            return Excel::download(new ExportApplicationReport($lists), 'ONETIME-Application-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.onetime.application-report');
        }
        
        
        
    }

    //  Later to be removed.
    public function exportApplicationReport()
    {/* 
        $lists = [];
        $fileName = 'file.xlsx';

        return Excel::download(
            new ExportApplicationReport($lists), $fileName
        ); */
        
    }

    public function budgetReport()
    {
        $lists = OnetimeApplication::whereHas('onetimeActionRecord', function($q){
            return $q->paidAt(request('paid_at'))
                    ->whereHas('transaction', function($t){
                        return $t->where('service_type', 'like', '%'.request('card_type').'%');
                    });
        })->whereHas('onetimeProductLists', function($q){
            return $q->where('drug_name', 'like', '%'.request('drug_name').'%')
                        ->where('brand_name', 'like', '%'.request('brand_name').'%');
        })
        ->whereNotIn('application_status', ['draft', 'trash'])
        ->certificateNo(request('certificate_no'))
        ->applicationNo(request('application_no'))
        ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
        // ->toSql();
        // dd($lists);
        ->paginate(request('ipp', 25));
        if( request('action') === 'report' ) {
            return Excel::download(new ExportBudgetReport($lists), 'Onetime-Budget-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.onetime.budget-report');
        }
        
    }

     //  Later to be removed.
    public function exportBudgetReport()
    {
       /*  $lists = [];
        $fileName = 'file.xlsx';

        return Excel::download(
            new ExportFinanceOnetimeReport($lists), $fileName
        ); */
        
    }

}
