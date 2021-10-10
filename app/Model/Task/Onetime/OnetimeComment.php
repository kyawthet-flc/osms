<?php

namespace App\Model\Task\Onetime;

use App\Model\Task\Attachment;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class OnetimeComment extends Model
{
    use \App\ApplicationLogTrait;
    protected $guarded = [];

    public static function boot() {
        parent::boot();
        static::created(function($onetimeComment) {
            foreach(request()->commentFiles??[] as $file) {
                $commentFile = array_merge(
                    (new Attachment)->extractFileInfo("drug", $file, date('d-m-Y'). "/onetime", 'onetime-commnet-' .date('YmdHis')),
                    [
                        'application_module_id' => $onetimeComment->onetimeApplication->application_module_id,
                        'application_type' => $onetimeComment->onetimeApplication->application_type,
                        'application_id' => $onetimeComment->onetimeApplication->id,
                        'sub_app_type' => 'comment',
                        'relation_id' => $onetimeComment->id
                    ]
                );
                $onetimeComment->attachments()->create($commentFile);
            }
        });
    }

    public function fromOfficer()
    {
        return $this->belongsTo(User::class, 'from_officer_id', 'id');
    }

    public function toOfficer()
    {
        return $this->belongsTo(User::class,'to_officer_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'relation_id', 'id')->where('application_module_id', 5)
            ->whereNotNull('relation_id')->whereSubAppType('comment');
    }

    public function onetimeApplication()
    {
        return $this->belongsTo(OnetimeApplication::class);
    }

}
