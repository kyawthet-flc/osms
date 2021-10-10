<div class="table-responsive">
    <table class="table {{$class ?? 'table-hover'}} table-bordered data-table" id="{{$id ?? ''}}" {{$attributes}}>
        @if($ths)
            <thead>
                <tr>
                    @foreach ($ths as $th)
                        <?php
                            $array = explode(':', $th);
                            $classes = '';
                            for($i = 1; $i<count($array); $i++){
                                $classes .= $array[$i].' ';
                            }
                        ?>
                        <th @if($array[0] == 'No.') style="width: 70px;" @endif

                            class="{{$array[0] == '' ? 'text-right ' : null }}{{$classes}}"
                        >{!! $array[0] !!}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            {{$slot}}
        </tbody>
    </table>
</div>