@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul style="margin-bottom: 0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif 

@section('js')

    @if(session()->has('error'))
      <script type="text/javascript">
        $(function(){

          Swal.fire({
            icon: 'error', title: 'Error', html: "{!! session()->get('error') !!}" })
          });

      </script>
    @endif

    @if(session()->has('success'))
    <script type="text/javascript">
       $(function(){
          Swal.fire({
            icon: 'success', title: 'Success', html: "{!! session()->get('success') !!}"
          });
          
       });
    </script>
@endif

@endsection
