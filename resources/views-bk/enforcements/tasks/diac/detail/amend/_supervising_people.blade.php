
 <h4 class="mt-3"><b>Supervising People</b></h4>
 <hr/>
  @foreach($application->diacAmendApplications->where('sub_relation_type', 'supervising_person')->groupBy('sub_relation_id') as $amendApps)  
  @foreach($amendApps as $amendApp )
  <h5 class="mt-3">
    <b>{{ remove_dash($amendApp->atrtribute) }}</b> - 
    <span @if($amendApp->is_changed=='yes') style="color: red;" @endif>{{ ($amendApp->value) }}</span>
  </h5>
  @endforeach  
  <hr/>
  @endforeach