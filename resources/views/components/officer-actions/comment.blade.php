<div class="actions-block-group" id="comment-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="comment-form" enctype= multipart/form-data>
       
        <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">

       <x-forms.select-with-key-value :attrs="[
          'name' => 'officer_id',
          'value' => '', 
          'placeholder' => '',
          'selected'=> old('officer_id'),
          'list' => App\User::whereHas('roles', function($q) { $q->where('roles.parent_id', App\Model\AccountSetup\Role::$officerGrpRoleId); })->excludingMe()->whereStatus('active')->pluck('name', 'id')->toArray() ], " />

        <textarea 
           placeholder="Comment" 
           name="body" 
           required="required"
           class="summernote-lib"></textarea>
           @csrf

        <div class="form-group mt-3">
            <label for="commentFiles">Addition Files(Optional)</label>
            <input type="file" id="commentFiles" multiple name="commentFiles[]"  class="form-control" />
        </div>
           
        <div class="mt-2 text-right">
            <input type="submit" class="btn btn-primary submit-action-btn" value="Submit">
        </div>
        
    </form>
</div>