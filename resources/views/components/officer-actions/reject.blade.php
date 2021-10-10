<div class="actions-block-group" id="reject-block" style="display: none;">
    <form action="{{  $actionUrl }}" method="post" id="reject-form">        
        <input type="hidden" name="toOfficerId" value="{{ $toOfficerId }}" />
        <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <input type="text" class="form-control mt-2 mb-2" name="subject" value="{{ $subject }}" placeholder="Subject" />
        <textarea 
           placeholder="Comment" 
           require="no" 
           name="body" 
           class="summernote-lib"></textarea>
           @csrf
           <div class="mt-2 text-right">
            <input type="submit" class="btn btn-danger no-alert submit-action-btn" value="Submit">
        </div>
    </form>
</div>