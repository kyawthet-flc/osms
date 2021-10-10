<div class="actions-block-group" id="approve-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="approve-form">        
        <input type="hidden" name="toOfficerId" value="{{ $toOfficerId }}" />
        <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <input name="displaySection" type="hidden" value="comment-block">
        <input type="text" class="form-control mt-2 mb-2" name="subject" value="{{ $subject }}" placeholder="Subject" />

        <textarea 
           placeholder="Comment" 
           require="no" 
           placeholder="Optional" 
           name="body" 
           class="summernote-lib">{{ $body }}</textarea>
            @csrf
        <div class="mt-2 text-right">
            <input type="submit" class="btn btn-success submit-action-btn" value="Submit">
        </div>
    </form>
</div>