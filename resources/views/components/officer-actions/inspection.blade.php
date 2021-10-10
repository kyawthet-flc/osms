<div class="actions-block-group" id="inspection-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="inspection-form">
        <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <input name="displaySection" type="hidden" value="inspection-block">
        <input type="text" class="form-control mt-2 mb-2" name="subject" value="{{ $subject }}" placeholder="Subject" />

        <textarea
           name="body"
           class="summernote-lib">{{ $body }}</textarea>
            @csrf

        <div class="form-group mt-3">
            <label for="inspectionFiles">Addition Files(Optional)</label>
            <input type="file" id="inspectionFiles" multiple name="inspectionFiles[]"  class="form-control" />
        </div>
            
        <div class="mt-2 text-right">
            <input type="submit" class="btn btn-primary submit-action-btn" value="Submit">
        </div>
    </form>
</div>
