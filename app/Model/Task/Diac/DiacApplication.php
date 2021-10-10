<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Attachment;
use App\Model\Task\Frontend\User as FrontendUser;
use App\Model\Task\Diac\DiacApplicationFilterTrait;

class DiacApplication extends Model
{
    use DiacApplicationFilterTrait;
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];

    protected $perPage = 10;

    public function parentDiacApplication()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function diacAmendApplications()
    {
        return $this->hasMany(DiacAmendApplication::class);
    }

    public function diacActionRecord()
    {
        return $this->hasOne(DiacActionRecord::class);
    }

    public function diacComments()
    {
        return $this->hasMany(DiacComment::class);
    }

    public function diacSupervisingPeople()
    {
        return $this->hasMany(DiacSupervisingPerson::class);
    }

    public function drugsToBeImported()
    {
        return $this->hasMany(DiacDrugToImport::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->where('application_module_id', 1)->whereNull('relation_id');
    }

    public function frontendUser()
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }

    public function diacPaymentRecords()
    {
        return $this->hasMany(DiacPaymentRecord::class);
    }

    public function incompletes()
    {
        return $this->hasMany(DiacIncomplete::class);
    }

    public function ddgDecisionHistory()
    {
        return $this->hasOne(\App\Model\Task\DdgDecisionHistory::class, 'application_id', 'id')->where('application_module_id', 1);
    }
 

    public function generateCertificateNo()
    {
        if ( is_null($this->certificate_no) ) {

            $lastApp = $this->whereIn('application_type',['new', 'renew'])
            ->where('id', '<>', $this->id)
            // ->whereNotIn('application_status',['draft', 'trash'])
            ->where('created_at', 'LIKE', date('Y').'%')
            ->orderBy('certificate_serial', 'desc')->whereNotNull('certificate_no')->first();

            // $lastAppModule = 'DIAC-C-';
            $ym = date('ym', strtotime($this->expire_date));
            $newSerialNo = '0001';

            if ( isset($lastApp) && $lastApp->application_no ) {
                $increSerialNo = $lastApp->application_serial + 1;
                $newSerialNo = str_pad($increSerialNo, 4, "0", STR_PAD_LEFT); 
            }

            $this->update([
                'certificate_no' => $ym . "I" . $newSerialNo,
                'certificate_serial' => $newSerialNo
            ]);

        }
    }

    // Status List
    public function isApproved()
    {
        return $this->application_status === 'approved';
    }

}
