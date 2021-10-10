<?php

namespace App\Model\Task\Dlmc;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Task\Attachment;
use App\Model\Task\Dlmc\DlmcApplication;
class DlmcComment extends Model
{
    protected $guarded = [];
    public static function boot() {
        parent::boot();
        static::created(function($dlmcComment) {
            foreach(request()->commentFiles??[] as $file) {
                $commentFile = array_merge(
                    (new Attachment)->extractFileInfo("drug", $file, date('d-m-Y'). "/dlmc", 'dlmc-comment-' .date('YmdHis')),
                    [
                        'application_module_id' => $dlmcComment->dlmcApplication->application_module_id,
                        'application_type' => $dlmcComment->dlmcApplication->application_type,
                        'application_id' => $dlmcComment->dlmcApplication->id,
                        'sub_app_type' => 'comment',
                        'relation_id' => $dlmcComment->id
                    ]            
                );
                $dlmcComment->attachments()->create($commentFile);
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

    public function dlmcApplication()
    {
        return $this->belongsTo(DlmcApplication::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'relation_id', 'id')->where('application_module_id', 4)
          ->whereNotNull('relation_id')->whereSubAppType('comment');
    }
}
