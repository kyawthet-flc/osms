<?php

namespace App\Model\Task\Diac;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Task\Attachment;
use App\Model\Task\Diac\DiacApplication;

class DiacComment extends Model
{
    protected $guarded = [];
    use \App\ApplicationLogTrait;

    public static function boot() {
        parent::boot();
        static::created(function($diacComment) {
            foreach(request()->commentFiles??[] as $file) {
                $commentFile = array_merge(
                    (new Attachment)->extractFileInfo("drug", $file, date('d-m-Y'). "/diac", 'diac-comment-' .date('YmdHis')),
                    [
                        'application_module_id' => $diacComment->diacApplication->application_module_id,
                        'application_type' => $diacComment->diacApplication->application_type,
                        'application_id' => $diacComment->diacApplication->id,
                        'sub_app_type' => 'comment',
                        'relation_id' => $diacComment->id
                    ]            
                );
                $diacComment->attachments()->create($commentFile);
            }
        });
    }

    public function FromOfficer()
    {
        return $this->belongsTo(User::class, 'from_officer_id', 'id');
    }

    public function ToOfficer()
    {
        return $this->belongsTo(User::class, 'to_officer_id', 'id');
    }

    public function diacApplication()
    {
        return $this->belongsTo(DiacApplication::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'relation_id', 'id')->where('application_module_id', 1)
          ->whereNotNull('relation_id')->whereSubAppType('comment');
    }

}