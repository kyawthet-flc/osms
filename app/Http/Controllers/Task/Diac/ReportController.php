<?php

namespace App\Http\Controllers\Task\Diac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Task\Diac\DiacApplication;

use Maatwebsite\Excel\Facades\Excel;

use App\Reports\Diac\ApplicationReport as ExportApplicationReport;
use App\Reports\Diac\BudgetReport as ExportBudgetReport;

class ReportController extends Controller
{
    
    public function applicationReport()
    {
        $lists = DiacApplication::whereHas('diacActionRecord', function($q){
            return $q->submittedAt(request('submitted_at'))
              ->resubmittedAt(request('resubmitted_at'))
              ->incompleteAt(request('incomplete_at'))
              ->autoCancelledAt(request('auto_cancelled_at'))
              ->rejectedAt(request('rejcted_at'))
              ->approvedAt(request('approved_at'));
        })
        ->whereHas('drugsToBeImported', function($q){
            return $q->genericName(request('generic_name'))
              ->brandName(request('brand_name'));
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
            return Excel::download(new ExportApplicationReport($lists), 'DIAC-Application-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.diac.application-report');
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
        $lists = DiacApplication::whereHas('diacActionRecord', function($q){
            return $q->paidAt(request('paid_at'));
        })
        ->whereNotIn('application_status', ['draft', 'trash'])
        ->certificateNo(request('certificate_no'))
        ->applicationNo(request('application_no'))
        ->applicationType(request('application_type'))
        ->orderBy(request('order_by', 'application_no'), request('direction', 'desc'))
        // ->toSql();
        // dd($lists);
        ->paginate(request('ipp', 25));

        if( request('action') === 'report' ) {
            return Excel::download(new ExportFinanceDiacReport($lists), 'DIAC-Budget-reporting.xlsx');
        } else {
            $this->data = array('lists' => $lists);
            return $this->viewPath('enforcements.tasks.reports.diac.budget-report');
        }
        
    }

     //  Later to be removed.
    public function exportBudgetReport()
    {
       /*  $lists = [];
        $fileName = 'file.xlsx';

        return Excel::download(
            new ExportFinanceDiacReport($lists), $fileName
        ); */
        
    }

}
