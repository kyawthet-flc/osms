<x-utils.card :attrs="['title' => 'Contact Form']">
    <x-forms.form-tag :attrs="['id' => 'contact-form', 'class' => 'contact-form', 'method' => 'post', 'action' => route('save_contact') ]">
        <x-forms.select-with-key-value :attrs="['name' => 'priority_level', 'selected' => $user->priority_level, 'label' => 'Level', 
            'list' => [
                'critical' => 'Critical',
                'important' => 'Important',
                'normal' => 'Normal',
                'low' => 'Low']
        ]" />
        <!-- - 4 hours
        - 24 hours
        - 3 days
        - 5 days -->
        <x-forms.text-input :attrs="['name' => 'subject', 'value' => $user->subject, 'label' => 'Subject', 'required' => true ]" />
        <x-forms.textarea :attrs="['name' => 'body', 'value' => $user->body, 'label' => 'Body', 'required' => true]" />

        <div class="form-group seperate-validation-wrapper"> 
            <label for="attachments">Files  (<span>Optional</span>)</label>
            <input type="file" name="contactFiles[]" multiple id="contactFiles" class="form-control">
            <div style="display: block;" class="validation-msg-holder"></div>
        </div>

        <x-forms.submit  confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}' :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'class' => 'common-sb-btn', 'label' => 'Send']" />
    </x-forms.form-tag>
</x-utils.card>