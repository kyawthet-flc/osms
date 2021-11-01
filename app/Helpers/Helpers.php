<?php

if ( !function_exists("active_file_driver") )
{
	function active_file_driver()
	{
		return config('filesystems.default');
	}
}

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

if ( !function_exists("remove_space") )
{
	function remove_space($str)
	{
		return preg_replace('/\ +/', '', $str);
	}
}

if ( !function_exists("remove_dash") )
{
	function remove_dash($str)
	{
		return ucwords(preg_replace('/\_+/', ' ', $str));
	}
}

if ( !function_exists("js_assets") )
{
	function js_assets($loadedType="initial")
	{
		$js = array(
			'app.js',
			'dashboard.js',
			'jquery.magnific-popup.min.js',
			'file-upload-with-preview.min.js',
			'global.js',
			'shop.js',
		);

		$html = '';

		foreach($js as $scriptFile):
			$scriptFile = asset('js/' . $scriptFile);
		    $html .= '<script loaded="'.$loadedType.'" type="text/javascript" src="' . ($scriptFile) . '"></script>';
		endforeach;
		return $html;
	}
}

if ( !function_exists("css_assets") )
{
	function css_assets()
	{
	}
}