<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;
use App\Model\Task\Attachment;

class DiacSupervisingPerson extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'relation_id', 'id')->where('application_module_id', 1)->whereSubAppType('step_2');
    }
}
