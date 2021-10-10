@extends('layouts.app')
@section('content') 

<x-utils.card :attrs="['title' => 'Application Log']">


    <div class="row mt-3 mb-4">
       <div class="col-md-12">
       <form action="{{ route('system_log.application.index') }}">
         <div class="form-group col-md-2">
          <select name="display_item" class="form-control" style="margin-bottom: 10px;">
              <option value="">Display Items</option>
              @foreach([10, 25, 50, 100] as $ipp)
              <option value="{{ $ipp }}"  
                  @if( request('display_item') == $ipp ) selected="selected" @endif> {{ $ipp }} - Item
              </option>
              @endforeach
          </select>
        </div>

        <div class="form-group col-md-2">
          <select name="user_type" class="form-control" style="margin-bottom: 10px;">
              <option value="">Select User Type</option>
              @foreach(['admin' => 'Admin', 'user' => 'User'] as $key => $name)
              <option value="{{ $key }}"  
                  @if( request('user_type') == $key ) selected="selected" @endif> {{ $name }}
              </option>
              @endforeach
          </select>
        </div>

        <div class="form-group col-md-2">
          <select name="table_name" class="form-control" style="margin-bottom: 10px;">
              <option value="">Select Table Name</option>
              @foreach($tableColumns as $key => $name)
              <option value="{{ $name }}"  
                  @if( request('table_name') == $name ) selected="selected" @endif> {{ remove_dash($name) }}
              </option>
              @endforeach
          </select>
        </div>

        <div class="form-group col-md-2">
          <select name="action" class="form-control" style="margin-bottom: 10px;">
              <option value="">Select Action</option>
              @foreach(['created' => 'Created', 'updated' => 'Updated', 'deleted' => 'Deleted',] as $key => $name)
              <option value="{{ $key }}"  
                  @if( request('action') == $key ) selected="selected" @endif> {{ $name }}
              </option>
              @endforeach
          </select>
        </div>

        <div class="form-group col-md-2">
          <select name="status" class="form-control" style="margin-bottom: 10px;">
              <option value="">Select Status</option>
              @foreach(['unread' => 'Unread', 'read' => 'Read'] as $key => $name)
              <option value="{{ $key }}"  
                  @if( request('status') == $key ) selected="selected" @endif> {{ $name }}
              </option>
              @endforeach
          </select>
        </div>

         <div class="col-md-2">
            <input placeholder="Search By Date Range" readonly="" type="text" value="{{ request('created_at') }}" name="created_at" label="Date" class="form-control daterangepicker-lib" />
        </div>

         <div class="col-md-12 text-left">
            <button type="submit" class="btn btn-success form-action-btn" value="search">Search</button>
            <a href="{{ route('system_log.application.index') }}" class="btn btn-danger no-alert">Clear</a>
        </div>

      </form>
      </div>
  </div>

  @if( count( request()->all() ) > 0 )
      <div class="row mt-1 mb-2 pl-3">
        <div class="col-md-12">
          <h6><b>Search Keys:</b></h6>
          @foreach(request()->all() as $key => $value)
            @if($value)
            <span style="font-size: 13px;"><b>{{ remove_dash($key) }}: </b> {{ remove_dash($value) }}</span>&nbsp;&nbsp;
            @endif
          @endforeach
        </div>
      </div>
      @endif

    <div class="table-responsive">
      <table class="table table-bordered">
          <thead>
              <th style="width: 70px;">No.</th>
              <th>User Name</th>
              <th>Table Name</th>
              <th>Action</th>
              <th>Status</th>
              <th>Date</th>
              <th>Action</th>
          </thead>
          <tbody>
               @php
                $indexer = ($applicationLogs->currentPage() - 1)  * $applicationLogs->perPage();
              @endphp

              @foreach ($applicationLogs as $k => $applicationLog)
              <tr>
                  <td>{{ $k + $indexer + 1 }}.</td>                  
                  @if( $applicationLog->user_type === 'admin')
                    <td>{{ optional($applicationLog->adminUser)->name }}</td>
                  @else
                    <td>{{ optional($applicationLog->applicantUser)->name }}</td>
                  @endif

                  <td>{{ remove_dash($applicationLog->table_name) }} ({{ $applicationLog->table_id }})(App ID: {{ $applicationLog->id }})</td>
                  <td>{{ $applicationLog->action }}</td>
                  <td>{{ $applicationLog->status }}</td>
                  <td>{{ $applicationLog->created_at }}</td>
                  <td>
                     @if( in_array($applicationLog->action ,['updated', 'deleted']))
                     <?php
                        $newData = json_decode($applicationLog->new_data, true)?? [];
                      ?>
                      <div data-lock="{{ $k }}" style="display: none;">
                          <div class="col-md-12">
                          @if($applicationLog->action === 'updated')
                            <h5><b>New Data</b></h5>
                          @endif
                          @foreach($newData as $key => $data)
                          <p class="mt-1 mb-1"><b>{{ $key }}: </b> {{ $data }}</p>
                          @endforeach
                          <hr/>

                          @foreach(json_decode($applicationLog->old_data, true)??[] as $key => $logOldData)
                          @if( !in_array($key, ['password']) )
                          <p class="mt-1 mb-1" style="color: {{ isset($newData[$key])?'red': ''  }}"><b>{{ $key }}: </b> {{ $logOldData }}</p>
                          @endif
                          @endforeach
                          <hr/>
                          
                          </div>
                      </div>

                     <button data-key="{{ $k }}" class="btn btn-danger no-alert data-key-button">
                       @if($applicationLog->action === 'updated')
                       <i class="fa fa-search" aria-hidden="true"></i>
                       @else
                       <i class="fa fa-eye" aria-hidden="true"></i>
                       @endif
                     </button>
                     @endif
                  </td>
              </tr>
              @endforeach

              @if( $applicationLogs->hasPages() )
                <tr>
                  <td colspan="7"> {{ $applicationLogs->appends( request()->all() ) }}</td>
                </tr>
              @endif
          </tbody>
      </table>
    </div>
</x-utils.card>

<div class="modal fade hidden-changed-data-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="row" style="padding: 3px 10px;">
          <div class="col-md-12">
                <div class="row content-feeder mt-2"></div>
                <div class="text-center mb-1 mb-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
           </div>
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
              $('.hidden-changed-data-list').modal('show');
          });

      }); 
    </script>
@endsection