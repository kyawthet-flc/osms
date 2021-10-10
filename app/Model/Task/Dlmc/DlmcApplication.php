<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Attachment as DrugAttachment;
use App\Model\Task\Frontend\User as FrontendUser;
use App\Model\Task\Dlmc\DlmcApplicationFilterTrait;
class DlmcApplication extends Model
{
    use DlmcApplicationFilterTrait;
    use \App\ApplicationLogTrait;

    protected $guarded = [];

    protected $perPage = 10;


    /*
    * Relations  
    */ 

    public function parentDlmcApplication()
    {
        return $this->hasOne(self::class, 'id', 'parent_id');
    }

    public function drugAttachments()
    {
        return $this->hasMany(DrugAttachment::class, 'application_id', 'id')->where('application_module_id', 4)->whereNull('relation_id');
    }

    public function dlmcPaymentRecords()
    {
        return $this->hasMany(DlmcPaymentRecord::class);
    }

    public function incompletes()
    {
        return $this->hasMany(DlmcIncomplete::class);
    }

    public function dlmcActionRecord()
    {
        return $this->hasOne(DlmcActionRecord::class);
    }

    public function dlmcDrugsToProduce()
    {
        return $this->hasOne(DlmcDrugsToProduce::class);
    }

    public function dlmcComments()
    {
        return $this->hasMany(DlmcComment::class);
    }

    public function incompleteVersionNo()
    {
        $result = $this->incompletes()->where('status', 'active')->first();
        return $result? $result->version_no: NULL;
    }

    public function incompleteFiles()
    {
        return $this->incompletes()->where('status', 'active')->pluck('file_code', 'id');
    }

    public function frontendUser()
    {
        return $this->belongsTo(FrontendUser::class, 'user_id', 'id');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function dlmcSupervisings()
    {
        return $this->hasMany(DlmcSupervising::class);
    }

    /*
    * Generate code 
    */
    public function generateCertificateNo()
    {
        if ( is_null($this->certificate_no) ) {

            $lastApp = $this->whereIn('application_type',['new', 'renew'])
            ->where('id', '<>', $this->id)
            // ->whereNotIn('application_status',['draft', 'trash'])->where('created_at', 'LIKE', date('Y').'%')
            ->orderBy('certificate_serial', 'desc')->whereNotNull('certificate_no')->first();

            $lastAppModule = 'DLMC-C-';
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

}
