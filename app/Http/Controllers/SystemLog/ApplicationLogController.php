<?php

namespace App\Http\Controllers\SystemLog;

use App\Http\Controllers\Controller;
use App\Model\SystemLog\ApplicationLog;
use Illuminate\Http\Request;

class ApplicationLogController extends Controller
{
    protected $basePath = 'enforcements.system-logs.applications.';
    
    public function index()
    {
        $this->data = array(
            'applicationLogs' => ApplicationLog::with(['adminUser', 'applicantUser'])->filters()->paginate( request('display_item')?? 10 ),
            'tableColumns' => ApplicationLog::select('table_name')->distinct()->pluck('table_name')->toArray()
        );
        return $this->viewPath('index');
    }
}
