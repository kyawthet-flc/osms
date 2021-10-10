<x-forms.text-input :attrs="['name' => 'name', 'value' => $list->name, 'placeholder' => '', 'label' => 'Name']" />
        
<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />

@section('js')
 @parent
 <script>
   $(function(){
     
   });
 </script>
@endsection