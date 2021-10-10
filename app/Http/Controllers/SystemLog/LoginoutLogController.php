<?php

namespace App\Http\Controllers\SystemLog;

use App\Http\Controllers\Controller;
use App\Model\SystemLog\LoginoutLog;
use Illuminate\Http\Request;

class LoginoutLogController extends Controller
{
    protected $basePath = 'enforcements.system-logs.loginouts.';
    
    public function index()
    {
        $this->data = array(
            'lists' => LoginoutLog::with(['user'])
            ->whereHas('user', function($q) {
              return $q->where('name', 'LIKE', '%'.request('name').'%');
            })->where(function($q){
                if(request('created_at')){
                    $date = date_range(request('created_at'));
                    return $q->whereBetween('created_at', $date);
                }
            })
            ->paginate(request('perPage', 25))
        );
        return $this->viewPath('index');
    }
}
