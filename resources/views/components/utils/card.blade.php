<div id="{{ $id }}" class="card {{ $class }}">
    @if( !empty($title) )
        <div class="card-header">
            @if(!empty($backUrl)) <a href="{{ $backUrl }}"><i class="mdi mdi-arrow-left-bold-circle"></i></a> @endif <strong class="card-title">{!! $title !!}</strong>
        </div>
    @endif
    <div class="card-body">
        {{$slot}}
    </div>
</div>
