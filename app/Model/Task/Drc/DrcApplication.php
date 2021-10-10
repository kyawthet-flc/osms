<?php

namespace App\Model\Task\Drc;

use App\Model\Task\Attachment;
use App\Model\Task\Frontend\User as FrontendUser;
use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Drc\DrcApplicationFilterTrait;
use App\Model\LabSection\LabResult;

class DrcApplication extends Model
{
    use DrcApplicationFilterTrait;
    use \App\ApplicationLogTrait;

    protected $guarded = [];
    protected $perPage = 10;

    public function parentDrcApplication()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function drcActionRecord()
    {
        return $this->hasOne(DrcActionRecord::class);
    }

    public function drcComments()
    {
        return $this->hasMany(DrcComment::class);
    }

    public function drcSampleInformation()
    {
        return $this->hasOne(DrcSampleInformation::class);
    }

    public function drcIngredients()
    {
        return $this->hasMany(DrcIngredient::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'application_id', 'id')->whereNull('relation_id');
    }

    public function drcApplicants()
    {
        return $this->hasMany(DrcApplicant::class);
    }

    public function drcProductOwners()
    {
        return $this->hasMany(DrcProductOwner::class);
    }

    public function drcEndProducts()
    {
        return $this->hasMany(DrcEndProductManufacturer::class);
    }

    public function drcActiveIngredients()
    {
        return $this->hasMany(DrcActiveIngredientManufacturer::class);
    }

    public function incompletes()
    {
        return $this->hasMany(DrcIncomplete::class);
    }

    public function drcOtherIngredients()
    {
        return $this->hasMany(DrcOtherManufacturer::class);
    }

    public function drcSampleInformations() {
        return $this->hasOne(DrcSampleInformation::class);
    }

    public function drcPaymentRecords()
    {
        return $this->hasMany(DrcPaymentRecord::class);
    }

    public function frontendUser()
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }

    public function ddgDecisionHistory()
    {
        return $this->hasOne(\App\Model\Task\DdgDecisionHistory::class, 'application_id', 'id')->whereIn('application_module_id', [1,2,3]);
    }

    public function generateCertificateNo()
    {
        if ( is_null($this->certificate_no) ) {

            $lastApp = $this->whereIn('application_type',['new', 'renew'])
                ->where('id', '<>', $this->id)
                // ->whereNotIn('application_status',['draft', 'trash'])->where('created_at', 'LIKE', date('Y').'%')
                ->orderBy('certificate_serial', 'desc')->whereNotNull('certificate_no')->first();

            $lastAppModule = 'DRC-C-';
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

    public function scopeApplicationNo($q, $value)
    {
        if($value){
            return $q->where('application_no', $value);
        }
        return $q;
    }

    public function isApproved()
    {
        return $this->application_status === 'approved';
    }

    public function labResult()
    {
        return $this->hasOne(LabResult::class);
    }

    public function getARelative() {
        if($this->drcApplicants()->exists()) {
            $data = $this->drcApplicants()->first();
        }else if($this->drcProductOwners()->exists()) {
            $data = $this->drcProductOwners()->first();
        }else if($this->drcEndProducts()->exists()) {
            $data = $this->drcEndProducts()->first();
        }else if($this->drcOtherIngredients()->exists()) {
            $data = $this->drcOtherIngredients()->first();
        }else if($this->drcActiveIngredients()->exists()) {
            $data = $this->drcActiveIngredients()->first();
        }else {
            $data = [];
        }
        return $data;
    }

}
