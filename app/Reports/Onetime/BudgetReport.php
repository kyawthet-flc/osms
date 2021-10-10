<?php

namespace App\Reports\Onetime;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BudgetReport implements FromView
{   
    protected $lists;

	public function __construct($lists) 
	{
		$this->lists = $lists;	
	}

    /**
    * @return View
    */
    public function view(): View
    {
    	return view('enforcements.tasks.reports.onetime.export-budget-report', ['lists' => $this->lists]);
    }
}
