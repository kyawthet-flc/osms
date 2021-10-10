<?php

namespace App\Model\Task\Drc;

use App\Model\Task\Attachment;
use Illuminate\Database\Eloquent\Model;

class DrcSampleInformation extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];
    protected $table = "drc_sample_informations";

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'relation_id', 'id');
    }

}
