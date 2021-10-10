<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Attachment as DrugAttachment;

class DlmcSupervising extends Model
{
    protected $guarded = [];

    public function drugAttachments()
    {
        return $this->hasMany(DrugAttachment::class, 'application_id', 'id')->where('application_module_id', 4)->whereNull('relation_id');
    }

}
