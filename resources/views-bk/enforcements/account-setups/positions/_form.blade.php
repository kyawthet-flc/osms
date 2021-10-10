<x-forms.text-input :attrs="['name' => 'name', 'value' => $user->name, 'placeholder' => '', 'label' => 'Name']" />
        
        <x-forms.text-input :attrs="['name' => 'login_id', 'value' => $user->login_id, 'placeholder' => '', 'label' => 'Login ID']" />
        
        <x-forms.text-input :attrs="['name' => 'email', 'value' => $user->email, 'placeholder' => '', 'label' => 'Email']" />

        <x-forms.password-input :attrs="['name' => 'password', 'value' => '', 'placeholder' => '', 'label' => 'Password']" />

        <x-forms.password-input :attrs="['name' => 'password_confirmation', 'value' => '', 'placeholder' => '', 'label' => 'Confirm Password']" />

        <x-forms.select-with-key-value :attrs="[
          'name' => 'status', 
          'label' => 'Status', 
          'value' => '', 
          'placeholder' => '', 
          'selected'=> $user->status,
          'list' => [
            'active' => 'Active',
            'inactive' => 'Inactive'
          ]], " />

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />