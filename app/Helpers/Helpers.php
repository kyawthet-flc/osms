<?php

if ( !function_exists("is_active_route") )
{
	function is_active_route($routeName, $bgColor = NULL)
	{
		if ( request()->routeIs($routeName) ) {
			return 'style="background-color: #F3F4FA"';
		}
		return '';
	}
}	

if ( !function_exists("current_url") )
{
	function current_url()
	{
		return request('redirectUrl')?? url()->full();
	}
}	

if ( !function_exists("date_range") )
{
	function date_range($data)
	{
		$result = null;
        if($data){
            try {
				//remove spaces
				$data = str_replace(' ', '', $data);

				$data = explode('-',$data);
				$from = explode('/',$data[0]);
				$to = explode('/',($data[1]?? '00/00/00'));
				$result = [
					'from' => $from[2].'-'.$from[1].'-'.$from[0].' 00:00:00',
					'to' => $to[2].'-'.$to[1].'-'.$to[0].' 23:59:59',
				];
			} catch (\Throwable $th) {
				//throw $th;
				return null;
			}
        }

        return $result;
	}
}

/*
* For admin case counter helpers
*/
if ( !function_exists("replace_space_with_dash") )
{
	function replace_space_with_dash($str)
	{
		return preg_replace('/\ +/', '-', $str);
	}
}

if ( !function_exists('caseCounter') )
{
	function caseCounter($count=null)
	{
		return $count? '<small class="nav-noti">'.$count.'</small>': null;
	}
}

if ( !function_exists('approvedCaseCounter') )
{
	function approvedCaseCounter($count=null)
	{
		return $count? '<small class="nav-approved-noti">'.$count.'</small>': null;
	}
}

if ( !function_exists('rejectedCaseCounter') )
{
	function rejectedCaseCounter($count=null)
	{
		return $count? '<small class="nav-rejcted-noti">'.$count.'</small>': null;
	}
}

if ( !function_exists('incompleteCaseCounter') )
{
	function incompleteCaseCounter($count=null)
	{
		return $count? '<small class="nav-incomplete-noti">'.$count.'</small>': null;
	}
}

if ( !function_exists('autoCancelledCaseCounter') )
{
	function autoCancelledCaseCounter($count=null)
	{
		return $count? '<small class="nav-auto-cancelled-noti">'.$count.'</small>': null;
	}
}

if ( !function_exists("remove_dash") )
{
	function remove_dash($str)
	{
		return ucwords(preg_replace('/\_+/', ' ', $str));
	}
}

if( !function_exists('temp_issue_expire_date') ) {

	function temp_issue_expire_date($validityYear="2 YEAR")
    {
    	$validityYear = $validityYear;
        $issueDate = date('d-m-Y');
        $tempExpireDate = strtotime($validityYear, strtotime($issueDate));
        $expireDate = date('d-m-Y', strtotime('-1 day', $tempExpireDate));
        return [ 'isdate' => $issueDate, 'exdate' => $expireDate ];
    }

}

if(! function_exists('getParametersType')) {
    function getParametersType()
    {
        $data = [
            'Pharmaceutical Chemistry Laboratory',
            'Biostandartization Laboratory',
            'Bio-assay Test',
            'Sterility Test',
            // 'Adventitious Bacteria and Fungi Test',
            'Microbial Limit Test',
        ];

        return $data;
    }
}
