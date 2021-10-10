<?php

namespace App\Model\SystemLog;

use Illuminate\Database\Eloquent\Model;
use App\User as AdminUser;
use App\Model\Task\Frontend\User as ApplicantUser;

class ApplicationLog extends Model
{
    protected $guarded = [];

    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class, 'user_id', 'id');//->where('user_type', 'admin');
    }

    public function applicantUser()
    {
        return $this->belongsTo(ApplicantUser::class, 'user_id', 'id');//->where('user_type', 'user');
    }
    /*
    retrieved
    creating
    created
    updating
    updated
    saving
    saved
    deleting
    deleted
    restoring
    restored
    */
    public function scopeFilters($q)
    {

        if (request('user_type')) $q->whereUserType(request('user_type'));
        if (request('table_name')) $q->whereTableName(request('table_name'));

        if (request('action')) $q->whereAction(request('action'));
        if (request('status')) $q->whereStatus(request('status'));

        if(request('created_at')){
            $date = date_range(request('created_at'));
            return $q->whereBetween('created_at', $date);
        }

        $q->where('user_id', '<>', '0');

        return $q;
    }
    /**
    *@param  $model, $actionName(create, update, delete)
    *@return void
    */
    public function createLog(Model $model, $action)
    {
 		$old_data = null;
 		$new_data = null;

    	if ( 'updated' === $action ) {

    		if ( $model->wasChanged() ) {
    			$old_data = json_encode($model->getOriginal());
    			$new_data = json_encode($model->getChanges());
    		}
    	} else {
            $old_data = json_encode($model->getOriginal());
        }

        if ( !is_null(auth()->user()) ) {

        	ApplicationLog::create([
        		'user_type' => 'admin',
    			'user_id' => auth()->user()->id?? '0',
    			'ip' => request()->ip(),
    			'table_name' => $model->getTable(),
    			'table_id' => $model->id,
    			'action' => strtolower($action),
    			'old_data' => $old_data,
    			'new_data' => $new_data
        	]);

        }
    	
    }

}