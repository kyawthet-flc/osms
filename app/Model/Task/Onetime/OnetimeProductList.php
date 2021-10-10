<?php

namespace App\Model\Task\Onetime;

use App\Model\ProductSetup\OnetimePurpose;
use App\Model\Task\Attachment;
use App\Model\Task\Drc\DrcApplication;
use Illuminate\Database\Eloquent\Model;

class OnetimeProductList extends Model
{
    use \App\ApplicationLogTrait;
    protected $guarded = [];
    
    public function onetimeApplication()
    {
        return $this->hasOne(OnetimeApplication::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'relation_id', 'id')->where('application_module_id', 5)->whereSubAppType('step_1');
    }
    public function purpose()
    {
        return $this->belongsTo(OnetimePurpose::class);
    }
    public function drcApplication()
    {
        return $this->belongsTo(DrcApplication::class);
    }
}
