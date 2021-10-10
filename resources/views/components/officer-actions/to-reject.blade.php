<div class="actions-block-group" id="to-reject-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="to-reject-form">    
        <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <textarea 
           placeholder="Comment"
           name="body" 
           class="summernote-lib"></textarea>
           @csrf
           <div class="mt-2 text-right">
            <input type="submit" class="btn btn-danger no-alert submit-action-btn" value="Submit">
        </div>
    </form>
</div>