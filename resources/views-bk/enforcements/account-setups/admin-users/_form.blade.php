<x-forms.text-input :attrs="['name' => 'name', 'value' => $user->name, 'placeholder' => '', 'label' => 'Name']" />

        @php
          $parentId = (!empty($user->roles->first()->parent_id)?$user->roles->first()->parent_id: ($user->roles->first()->id?? 0));
        @endphp
        <x-forms.select-with-key-value :attrs="[
          'name' => 'role', 
          'label' => 'Role', 
          'value' => '', 
          'placeholder' => '', 
          'selected'=> $parentId,
          'list' => $roles]" />

        <div class="form-group sub-role-wrapper" style="display: noane;">
           <select class="form-control select2 sub-role-select" id="sub_role" name="sub_role"></select>
           @if($errors->has('sub_role'))
              <div class="error mt-2 text-danger">{{ $errors->first('sub_role') }}</div>
          @endif
        </div>
        
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

@section('js')
 @parent
 <script>
   $(function(){
      var subRoles = @json($subRoles);
      var selectedRoleId = '{{ old("role", $parentId) }}';
      var selectedSubRoleId = '{{ old("sub_role", ($user->roles->first()->id?? 0)) }}';

      handleSubRole(selectedRoleId, selectedSubRoleId);

      $('select[name="role"]').change(function(e){
        handleSubRole($(this).val(), selectedSubRoleId)
      });

      function handleSubRole(selectedParentRole, selectedSubRoleId)
      {
        if( typeof(subRoles[selectedParentRole]) === 'object') {

            $('.sub-role-wrapper').show();

            var selectionBlade = '<option value="">Please Select</option>';
            $.each(subRoles[selectedParentRole], function(k, obj){

                var isSelected = (selectedSubRoleId? selectedSubRoleId: selectedRoleId) == obj.id?'selected="selected"': '';
                selectionBlade += '<option '+isSelected+' value="'+obj.id+'">' + obj.name + '</option>';
            });

            $('.sub-role-select').html(selectionBlade);

            } else {
               $('.sub-role-wrapper').hide();
               $('select[name="sub_role"]').val('');
            }
        }
   })
 </script>
@endsection