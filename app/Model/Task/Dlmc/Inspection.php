<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Attachment as DrugAttachment;

class Inspection extends Model
{
    use \App\ApplicationLogTrait;

    //inspect, send, submitted, incomplete, done are inspection status
    protected $guarded = [];

    public function drugAttachments()
    {
        return $this->hasMany(DrugAttachment::class, 'application_id', 'id')->where('application_module_id', 4)->where('file_field', 'inspection-file')->whereNull('relation_id');
    }

    public function dlmcApplication()
    {
        return $this->belongsTo(DlmcApplication::class, 'dlmc_application_id', 'id');
    }

    public function inspectionCorrections()
    {
        return $this->hasMany(InspectionCorrection::class);
    }

}
