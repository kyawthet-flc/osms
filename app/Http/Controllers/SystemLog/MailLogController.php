<?php

namespace App\Http\Controllers\SystemLog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SystemLog\MailLog;

class MailLogController extends Controller
{
    protected $basePath = 'enforcements.system-logs.mails.';
    
    public function index()
    {
        $this->data = array(
            'lists' => MailLog::filters()->paginate(request('perPage', 25))//ApplicationLog::with(['adminUser', 'applicantUser'])->filters()->paginate( request('display_item')?? 10 )
        );
        return $this->viewPath('index');
    }
}
