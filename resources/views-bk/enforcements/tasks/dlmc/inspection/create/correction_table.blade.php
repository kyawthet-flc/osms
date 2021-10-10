<x-utils.data-table class="table" :ths="[
    'No.',
    'Non-Compliance',
    'Correction Action Request',
    'Due Date',
    'Corrective Evidenced',
    'Remark',
    'Status',
    'Action',
]">
@foreach ($inspection->inspectionCorrections as $k => $inspectionCorrection)
    <tr>
        <td>{{ $k + 1 }}</td>
        <td>{{ $inspectionCorrection->non_compliance }}</td>
        <td>{{ $inspectionCorrection->correction_action }}</td>
        <td>{{ $inspectionCorrection->due_date }}</td>
        <td>
            @foreach ($inspectionCorrection->drugAttachments??[] as $attachment)    
                <a onclick="window.open('{{ route('tasks.dlmc.show_document', $attachment) }}', '_blank', 'fullscreen=yes'); return false;"
                    href="{{ route('tasks.dlmc.show_document', $attachment) }}" class="btn btn-primary mb-2">View File</a><br>
            @endforeach
        </td>
        <td>
            @if (count($inspectionCorrection->correctionComments) == 0)
                N/A
            @else    
                @foreach ($inspectionCorrection->correctionComments??[] as  $key => $correctionComment)
                    {{ $key + 1 }}. {{ $correctionComment->comment}} <br>
                @endforeach
            @endif
        </td>
        <td>{{ $inspectionCorrection->status }}</td>
        <td>
            @if ($inspectionCorrection->status == 'initiated')
                <a href="{{ route('tasks.dlmc.corrective.edit', ['dlmcApplication' => $dlmcApplication, 'inspection' => $inspection, 'inspectionCorrection' => $inspectionCorrection]) }}" class="btn btn-warning edit-correction"><i class='fa fa-pencil'></i></a>

                <form action="{{ route('tasks.dlmc.corrective.delete', $inspectionCorrection) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn btn-danger no-alert delete-correction"><i class='fa fa-trash'></i></button>
                </form>
            @endif

            @if ($inspectionCorrection->status == 'submitted' ||  $inspectionCorrection->status == 'resubmitted')
                @php
                       $pendingBtn = auth()->user()->hasPermission('dlmc', 'pending-inspection');
                       $acceptingBtn = auth()->user()->hasPermission('dlmc', 'accepting-inspection');
                @endphp
                @if( $pendingBtn )
                    <button type="button" class="btn btn-warning mt-1" data-toggle="modal" data-target="#incomplete-correction-{{ $k }}">Pending</button>
                @endif
                @if( $acceptingBtn )
                    <a href="{{ route('tasks.dlmc.inspection.acepting', compact('inspection', 'inspectionCorrection')) }}" class="btn btn-success accept-correction-btn mt-1">Accept</a>
                @endif
            @endif
        </td>

        <!-- start pending Modal -->
        <div class="modal fade" id="incomplete-correction-{{ $k }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="pending-form-{{$inspectionCorrection->id}}" action="{{ route('tasks.dlmc.inspection.pending', compact( 'dlmcApplication', 'inspection', 'inspectionCorrection') ) }}" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pending Inspection Correction</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p style="color: red;font-size: 14px;display: none;text-align: center;font-weight: bold;" class="validation-msg-wraper"></p>
                                <label>Remark</label>
                                <textarea class="form-control" name="remark">{{ old('remark') }}</textarea>
                            </div>
                        </div>

                        </div>
                        <div class="modal-footer">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary pending-save-setter" app-id="{{$inspectionCorrection->id}}">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- start pending Modal -->   
    </tr>
@endforeach
</x-utils.data-table>

<!-- start edit Modal -->
<div class="modal fade bd-example-modal-xl" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Inspection Correction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="container-fluid inspection-correction-wrapper">
            
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>
<!-- end edit Modal -->

@section('js')
    @parent
    <script type="text/javascript">
        $(function(){

            /*--------------start pending correction action -----------*/
            $('.pending-save-setter').click(function(e) {
                var appId = $(this).attr('app-id');
                var form = $('#pending-form-'+appId);
            
    
                $.ajax({
                method: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize()
                }).then(function(result){

                if  ( 'success' === result.status) {
                    window.location.href = result.redirectUrl
                }

                if ( 'error' === result.status ) {
                    form.find('.validation-msg-wraper').html(result.msg).show();
                }

                }).catch(function(err, xhr, text){
                
                if (err.status === 422) {                         
                        for(var fieldname in err.responseJSON.errors ) {
                        if ( typeof(err.responseJSON.errors[fieldname][0]) !== 'undefined' ) {
                            form.find('.validation-msg-wraper').html(err.responseJSON.errors[fieldname][0]).show();
                        }    
                    }            
                    }

                }); 
            });

            /*--------------start accept correction action -----------*/
            $('.accept-correction-btn').click(function(e){
                e.preventDefault();
                var self = $(this);
                Swal.fire({
                    title: "Are you sure you want to accept, and after this case will be complete?",
                    // text: "You won't be able to revert this!",
                    // icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    icon: 'info',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    // self.parent('form').submit();
                    window.location.href = self.attr('href')
                }
                return false;
                });
                return false;

            });

            /*--------------start correction delete action -----------*/
            $('.delete-correction').click(function(e){
                e.preventDefault();
                var self = $(this);
                Swal.fire({
                    title: "Are you sure you want to delete?",
                    // text: "You won't be able to revert this!",
                    // icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    icon: 'error',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    self.parent('form').submit();
                }
                return false;
                });
                return false;

            });

            /*-----------------start update correction actiom-------------------------8*/
            $('.edit-correction').click(function(event){
                event.preventDefault();
                var self = $(this);
                $.ajax({ 
                    url: self.attr('href')
                }).then(function(response){
                    $('.inspection-correction-wrapper').html(response.data);
                    $('#editModal').modal('show');

                }).catch(function(err, xhr, text) {
                    // toastr.error("Cannot Delete.Try again later.");
                });
            });

            $('.inspection-correction-wrapper').on('click', '.save-correction-btn', function(event){
                event.preventDefault();
                var form = $(this).parents('form');// $('.inspection-correction-wrapper').find('#save-correction-form');
                var self = $(this);

                $.ajax({ 
                    url: form.attr('action'),
                    method: 'put',
                    data: form.serialize()
                }).then(function(response){
                    
                    if ( response.status === 'success' ) {
                        
                        if ( response.shouldDisplayToast === false ) {
                            window.location.href = response.redirectUrl;
                        } else {
                            // ElementHelpers.customToastr('Successfully Uploaded.');
                            setTimeout(function(){
                            // ElementHelpers.enableElement( self );
                                window.location.href = response.redirectUrl;
                            }, 1000);
                        }
                    }

                    if ( response.status === 'error' && response.shouldDisplayToast ) {
                        // ElementHelpers.customToastr(response.msg, 'error');
                    }
                    // ElementHelpers.enableElement( self );

                }).catch(function(err, xhr, text) {
                    // ElementHelpers.customToastr('Please fill some input.', 'error');
                    if (err.status === 422) {                        
                        $(document).find('.ajax-text-danger').remove();
                        for(var fieldname in err.responseJSON.errors ) {
                            if ( typeof(err.responseJSON.errors[fieldname][0]) !== 'undefined' ) {
                                $('<span class="text-danger ajax-text-danger">'+err.responseJSON.errors[fieldname][0]+'</span>').appendTo(
                                    $('.inspection-correction-wrapper').find('[name="'+fieldname+'"]'
                                ).parent('div')); 
                            }    
                    }            
                    }
                    // ElementHelpers.enableElement( self );
                });
            });

        });
    </script>
@endsection