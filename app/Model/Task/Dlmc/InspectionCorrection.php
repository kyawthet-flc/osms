<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Attachment as DrugAttachment;
class InspectionCorrection extends Model
{
    use \App\ApplicationLogTrait;
    // initiated, send, submitted, incomplete, Complete are InspectionCorrection status

    protected $guarded = [];

    public function drugAttachments()
    {
        return $this->hasMany(DrugAttachment::class, 'application_id', 'id')->where('application_module_id', 4)->where('file_field', 'corrective-file')->whereNull('relation_id');
    }

    public function correctionComments()
    {
        return $this->hasMany(CorrectionComment::class);
    }
}
