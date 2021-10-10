@extends('layouts.app')

@section('title') Inspection @endsection

@section('content')

    <div class="col-md-12 text-right mb-3">
        <a class="btn btn-info" href="{{ route('tasks.dlmc.show', ['dlmcApplication' => $dlmcApplication]) }}">Back</a>
    </div>
    <x-utils.card :attrs="['title' => 'Inspection Result']">
        <x-forms.form-tag :attrs="['id' => 'inspection-form', 'class' => 'inspection-form', 'method' => 'post', 'action' => route('tasks.dlmc.inspection.store', $inspection) ]">
            @include('enforcements.tasks.dlmc.inspection.create._form')
        </x-forms.form-tag>
        @if ($inspection->inspection_result_status == 'Satisfied after correction')
            <br>
            @if ($inspection->status == 'inspect')    
                <hr>
                    @include('enforcements.tasks.dlmc.inspection.create._correction_form')
                <br>
            @endif
            @if ( count($inspection->inspectionCorrections) > 0)
                <hr>
                <br>
                    @include('enforcements.tasks.dlmc.inspection.create.correction_table')

                    @if ($inspection->status == 'inspect')     
                        <div class="col-md-12 text-center">
                            <form id="send-form" action="{{route('tasks.dlmc.inspection.send', $inspection)}}" method="put">
                                <div class="col-md-12 text-center">
                                    <input type="submit" class="btn btn-success send-correction-btn" value="Send To Applicant">
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
        @endif
	</x-utils.card>
@endsection
@section('js')
    @parent
    <script type="text/javascript">
        $(function(){
            /*--------------start send correction action -----------*/
            $('.send-correction-btn').click(function(e){
                e.preventDefault();
                var self = $(this);
                Swal.fire({
                    title: "Are you sure you want to send, and you can't edit or delete after sending?",
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
                    self.parents('form#send-form').submit();
                }
                return false;
                });
                return false;

            });
        });
    </script>
@endsection
