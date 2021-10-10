<div class="actions-block-group" id="local-payment-block" style="display: none;">
    <form action="{{ $actionUrl }}" method="post" id="local-payment-form">
        <input name="redirectUrl" type="hidden" value="{{ request()->fullUrl() }}">
        <input name="displaySection" type="hidden" value="local-payment-block">
        <input type="text" class="form-control mt-2 mb-2" name="subject" value="{{ $subject }}" placeholder="Subject" />
        <input type="number" class="form-control mt-2 mb-2" name="amount" value="{{ $amount }}" placeholder="Amount" />

        <textarea
           name="body"
           class="summernote-lib">{{ $body }}</textarea>
            @csrf
        <div class="mt-2 text-right">
            <input type="submit" class="btn btn-warning submit-action-btn" value="Submit">
        </div>
    </form>
</div>
