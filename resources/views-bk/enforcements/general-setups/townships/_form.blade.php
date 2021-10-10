<x-forms.select-with-key-value :attrs="[
    'name' => 'division_id', 
    'required' => 'required', 
    'value' => $township->division_id, 
    'placeholder' => '', 
    'selected' => $township->division_id,
    'list' => $divisions,
    'label' => 'State/ Division']" />

<div class="form-group" style="display: noane;">
<label for="">District<span class="text-danger">*</span>
    </label>
    <select class="form-control select2" id="district_id" name="district_id"></select>
    @if($errors->has('district_id'))
        <div class="error mt-2 text-danger">{{ $errors->first('district_id') }}</div>
    @endif
</div>  

<x-forms.text-input :attrs="[
    'name' => 'name', 
    'required' => 'required', 
    'value' => $township->name, 
    'placeholder' => '', 
    'label' => 'Name']" />

<x-forms.text-input :attrs="[
    'name' => 'name_mm', 
    'value' => $township->name_mm, 
    'placeholder' => ' ', 
    'label' => 'Name(in Myanmar)']" />

<x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />


@section('js')
@parent
<script>
  
  $(function(){

    var districts = @json($districts);

    var selectedDivisionId = '{{ old("division_id", $township->division_id) }}';
    var selectedDistrictId = '{{ old("district_id", $township->district_id) }}';

    function displayDistrict(divisionId)
    {
        var html = '<option value="">Please Select</option>';
        districts.filter(function (obj) {
            return obj.division_id == divisionId;
        }).map(function(obj){
            html += '<option '+(selectedDistrictId == obj.id? 'selected="selected"': '')+' value="'+obj.id+'">'+obj.name+'</option>';
        });
        $('select[name="district_id"]').html(html);
    }

    /* function displayTownship(districtId)
    {
        var html = '<option value="">Please Select</option>';
        townships.filter(function (obj) {
            return obj.district_id == districtId;
        }).map(function(obj){
            html += '<option value="'+obj.id+'">'+obj.name+'</option>';
        });
        $('select[name="township_id"]').html(html)

    } */

    $('select[name="division_id"]').change(function(e){
        displayDistrict( $(this).val() );
    });

    displayDistrict(selectedDivisionId);

    // $(document).find('select[name="district_id"]').html();
    /* $(document).find('select[name="district_id"]').change(function(e){
       displayTownship( $(this).val() );
    }); */

  });

</script>
@endsection