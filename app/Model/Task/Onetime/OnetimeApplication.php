<?php

namespace App\Model\Task\Onetime;

use App\Model\Task\Attachment;
use App\Model\Task\Frontend\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Diac\DiacApplication;
use App\Model\Task\Frontend\User as FrontendUser;
use App\Model\Task\Onetime\OnetimeApplicationFilterTrait;

class OnetimeApplication extends Model
{
    use OnetimeApplicationFilterTrait;
    use \App\ApplicationLogTrait;
    protected $guarded = [];

    public function onetimeActionRecord()
    {
        return $this->hasOne(OnetimeActionRecord::class);
    }
    public function onetimeComments()
    {
        return $this->hasMany(OnetimeComment::class);
    }

    public function ddgDecisionHistory()
    {
        return $this->hasOne(\App\Model\Task\DdgDecisionHistory::class, 'application_id', 'id')->where('application_module_id', 5);
    }     

    // Status List
    public function isApproved()
    {
        return $this->application_status === 'approved';
    }
    public function onetimeProductLists()
    {
        return $this->hasMany(OnetimeProductList::class);
    }
    public function getNewStep1Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_1');
    }
    public function getNewStep10Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_1_0');
    }
    public function getNewStep101Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_1_0_1');
    }
    public function getNewStep11Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_1_1');
    }
    public function getNewStep12Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_1_2');
    }
    public function getNewStep2Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_2');
    }
    public function frontendUser()
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }
    public function getNewStep20Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_2_0');
    }
    public function getNewStep21Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_2_1');
    }
    public function getNewStep3Files()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_3');      
    }
    
    public function onetimePaymentRecords()
    {
        return $this->hasMany(OnetimePaymentRecord::class);
    }
    public function incompletes()
    {
        return $this->hasMany(OnetimeIncomplete::class);
    }
    public function diacApplication()
    {
        return $this->belongsTo(DiacApplication::class);
    }
    public function generateCertificateNo()
    {
        if ( is_null($this->certificate_no) ) {

            $lastApp = $this->whereIn('application_type',['new', 'renew'])
            ->where('id', '<>', $this->id)
            // ->whereNotIn('application_status',['draft', 'trash'])->where('created_at', 'LIKE', date('Y').'%')
            ->orderBy('certificate_serial', 'desc')->whereNotNull('certificate_no')->first();

            $lastAppModule = 'ONETIME-';
            $year = date('Y'). '-';
            $newSerialNo = '00000001';

            if ( isset($lastApp) && $lastApp->application_no ) {
                $increSerialNo = $lastApp->application_serial + 1;
                $newSerialNo = str_pad($increSerialNo, 6, "0", STR_PAD_LEFT); 
            }

            $this->update([
                'certificate_no' => $lastAppModule . $year . $newSerialNo,
                'certificate_serial' => $newSerialNo
            ]);

        }
    }
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

}
