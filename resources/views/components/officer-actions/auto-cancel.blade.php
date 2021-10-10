<div class="actions-block-group" id="auto-cancel-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="auto-cancel-form">    
    <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <input type="text" class="form-control mt-2 mb-2" name="subject" value="{{ $subject }}" placeholder="Subject" />
        <textarea 
           placeholder="Comment" 
           require="no" 
           name="body" 
           class="summernote-lib"></textarea>
           @csrf
        <div class="mt-2 text-right">
            <input type="submit" class="btn btn-info submit-action-btn" value="Submit">
        </div>
    </form>
</div>