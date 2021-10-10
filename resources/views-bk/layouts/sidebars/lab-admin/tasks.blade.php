@php
   $labCounters = auth()->user()->labCounters();
@endphp

<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="menu-icon fa fa-tasks"></i>Lab Steup</a>
    <ul class="sub-menu children dropdown-menu show">
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('lab_section.setup.parameters.index') }}">Parameter</a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('lab_section.setup.parameters.create') }}">New Parameter</a>
      </li>
      <hr />
        <li>
            <i class="fa fa-tasks"></i>
            <a href="{{ route('lab_section.setup.test_parameters.index') }}">Test Parameters</a>
        </li>
        <li>
            <i class="fa fa-tasks"></i>
           <a href="{{ route('lab_section.setup.reference_method.index') }}">Reference Method</a>
        </li>
        <li>
            <i class="fa fa-tasks"></i>
            <a href="{{ route('lab_section.setup.reference_value.index') }}">Reference Value/ Specification</a>
        </li>
        <li>
            <i class="fa fa-tasks"></i>
            <a href="{{ route('lab_section.setup.microbial.index') }}">Microbial Limit Test</a>
        </li>
        <li>
            <i class="fa fa-tasks"></i>
            <a href="{{ route('lab_section.setup.adventitious.index') }}">Adventitious Bacteria Test</a>
        </li>
  </ul>
</li>

<li class="menu-item-has-children dropdown show">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      <i class="menu-icon fa fa-tasks"></i>Lab Request
    </a>
    <ul class="sub-menu children dropdown-menu show">
      <!-- <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('lab_section.drc.index',['labTypeStatus' => 'to_check']) }}">DRC Lab {!! caseCounter($labCounters['drc']) !!}</a>
      </li> -->
      <li class="menu-item-has-children dropdown show">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            DRC
          </a>
          <ul class="sub-menu children dropdown-menu show">
            <li>
              <a href="{{ route('lab_section.drc.index',['labTypeStatus' => 'to_check', 'applicationType' => 'new','applicationModuleId' => 2]) }}">DRC(Import) {!! caseCounter($labCounters['drc']) !!}</a>
            </li>
            <li>
              <a href="{{ route('lab_section.drc.index',['labTypeStatus' => 'to_check', 'applicationType' => 'new','applicationModuleId' => 3]) }}">DRC(Local) {!! caseCounter($labCounters['drcLocal']) !!}</a>
            </li>
          </ul>
      </li>

    <!--   <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('lab_section.drc.index',['labTypeStatus' => 'to_check']) }}">DRC Local Lab {!! caseCounter($labCounters['drcLocal']) !!}</a>
      </li>  -->
      <li class="menu-item-has-children dropdown show">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Renew
          </a>
          <ul class="sub-menu children dropdown-menu show">
          <li>
              <a href="{{ route('lab_section.drc.index',['labTypeStatus' => 'to_check', 'applicationType' => 'renew','applicationModuleId' => 2]) }}">DRC(Import) {!! caseCounter($labCounters['drcRenew']) !!}</a>
            </li>
            <li>
              <a href="{{ route('lab_section.drc.index',['labTypeStatus' => 'to_check', 'applicationType' => 'renew', 'applicationModuleId' => 3]) }}">DRC(Local){!! caseCounter($labCounters['drcLocalRenew']) !!}</a>
            </li>
          </ul>
      </li>

    </ul>
</li>
