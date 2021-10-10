<div class="actions-block-group" id="to-approve-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="to-approve-form">       
    <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <textarea 
           placeholder="Comment" 
           require="no" 
           name="body" 
           class="summernote-lib"></textarea>
           @csrf
           <div class="mt-2 text-right">
            <input type="submit" class="btn btn-success submit-action-btn" value="Submit">
        </div>
    </form>
</div>