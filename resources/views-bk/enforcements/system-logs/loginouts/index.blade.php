@extends('layouts.app')
@section('content')

<x-utils.card :attrs="['title' => 'Login/ Logout of Admin Users']">

<div class="row mt-3 mb-4">
      <div class="col-md-12">
      <form action="{{ route('system_log.loginout.index') }}">
        <div class="form-group col-md-3">
        <select name="perPage" class="form-control" style="margin-bottom: 10px;">
            <option value="">Display Items</option>
            @foreach([1, 10, 25, 50, 100] as $perPage)
            <option value="{{ $perPage }}"  
                @if( request('perPage') == $perPage ) selected="selected" @endif> {{ $perPage }} - Item
            </option>
            @endforeach
        </select>
      </div>

      <div class="form-group col-md-3">
          <input name="name" placeholder="Name" value="{{ request('name') }}" class="form-control" style="margin-bottom: 10px;" />
      </div>

<div class="col-md-3">
    <input placeholder="Search By Login/Out Range" readonly="" type="text" value="{{ request('created_at') }}" name="created_at" label="Date" class="form-control daterangepicker-lib" />
</div>

        <div class="col-md-12 text-right">
          <button type="submit" class="btn btn-success form-action-btn" value="search">Search</button>
          <a href="{{ route('system_log.loginout.index') }}" class="btn btn-danger no-alert">Clear</a>
      </div>

    </form>
    </div>
</div>

 
    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>User Name</th>
          <th>User E-mail</th>
          <th>Login/ Logout</th>
          <th>Datetime</th>
          <th>IP</th>
        </thead>
        <tbody>
          @foreach ($lists as $k => $list)
          <tr  class="bank-display-wrapper">
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->user->name }}</td>
            <td>{{ $list->user->email }}</td>
            <td>
              @if( $list->action_type === 'logged_out' )
              Logged Out <i class="fa fa-arrow-right" aria-hidden="true"></i>
              @else
              <i class="fa fa-arrow-left" aria-hidden="true"></i> Logged In
              @endif

            </td>
            <td>{{ $list->created_at }}</td>
            <td>{{ $list->ip }}<br/><p style="font-size: 11px;">{{ $list->user_agent }}</p></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $lists->appends(request()->all())->links() }}
</x-utils.card>

<div style="width: 100% !important;" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style=" width: 100%;max-width: none;height: 100%;margin: 0;" role="document">
    <div class="modal-content" style="height: 100%;width: 100%;border: 0;border-radius: 0;" role="document"> 
        <div class="row content-feeder" style="width: 100% !important;height: auto;padding: 20px 25px;"></div>
        <div class="text-center mb-1 mb-3">
            <button type="button" class="mt-3 btn btn-danger no-alert" data-dismiss="modal">Close</button>
        </div>  
    </div>
  </div>
</div>
@endsection

@section('js')
    @parent
    <script type="text/javascript">
      $(function() {
          $('.data-key-button').click(function(e){
              e.preventDefault();
              $('.content-feeder').html( $('div[data-lock='+($(this).data('key'))+']').html() );
              $('.modal').modal('show');
          });
      }); 
    </script>
@endsection