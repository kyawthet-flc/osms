<div class="actions-block-group" id="preview-rejection-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="preview-rejection-form">        
        <input type="hidden" name="toOfficerId" value="{{ $toOfficerId }}" />
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