<?php

namespace App\Model\Task\Drc;

use App\Model\Task\Attachment;
use App\User;
use Illuminate\Database\Eloquent\Model;

class DrcComment extends Model
{
    use \App\ApplicationLogTrait;
    
    protected $guarded = [];

    public static function boot() {
        parent::boot();
        static::created(function($drcComment) {
            foreach(request()->commentFiles??[] as $file) {
                $commentFile = array_merge(
                    (new Attachment)->extractFileInfo("drug", $file, date('d-m-Y'). "/drc", 'drc-commnet-' .date('YmdHis')),
                    [
                        'application_module_id' => $drcComment->drcApplication->application_module_id,
                        'application_type' => $drcComment->drcApplication->application_type,
                        'application_id' => $drcComment->drcApplication->id,
                        'sub_app_type' => 'comment',
                        'relation_id' => $drcComment->id
                    ]
                );
                $drcComment->attachments()->create($commentFile);
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
        return $this->hasMany(Attachment::class, 'relation_id', 'id')->whereIn('application_module_id', [2,3])
            ->whereNotNull('relation_id')->whereSubAppType('comment');
    }

    public function drcApplication()
    {
        return $this->belongsTo(DrcApplication::class);
    }
}
