@php
    $exist_applicant = $application->drcApplicants()->exists();
    $exist_owner = $application->drcProductOwners()->exists();
    $exist_end_product = $application->drcEndProducts()->exists();
    $exist_active_ingredient = $application->drcActiveIngredients()->exists();
    $exist_other_ingredient = $application->drcOtherIngredients()->exists();
@endphp

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @if($exist_applicant)
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-applicant" role="tab" aria-controls="nav-applicant" aria-selected="true"><i class="fa fa-info-circle" style="color:#ccc;"></i> Applicant/MAH</a>
        @endif
        @if($exist_owner)
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-owner" role="tab" aria-controls="nav-owner" aria-selected="false"><i class="fa fa-info-circle" style="color:#ccc;"></i> Product Owner</a>
        @endif
        @if($exist_end_product)
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-product" role="tab" aria-controls="nav-product" aria-selected="false"><i class="fa fa-info-circle" style="color:#ccc;"></i> End Product Manufacturer</a>
        @endif
        @if($exist_active_ingredient)
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-ingredient" role="tab" aria-controls="nav-owner" aria-selected="false"><i class="fa fa-info-circle" style="color:#ccc;"></i> Active Ingredient Manufacturer</a>
        @endif
        @if($exist_other_ingredient)
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-other" role="tab" aria-controls="nav-product" aria-selected="false"><i class="fa fa-info-circle" style="color:#ccc;"></i> Other Manufacturer</a>
        @endif
    </div>
</nav>
<div class="tab-content mt-3" id="nav-tabContent">
    @if($exist_applicant)
        <div class="tab-pane fade active" id="nav-applicant" role="tabpanel" aria-labelledby="nav-home-tab">
            @foreach($application->drcApplicants as $app)
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Domestic/Foreign') }}</div>
                    <div class="col-md-9">{{ $app->domestic_or_foreign }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Company Code') }}</div>
                    <div class="col-md-9">{{ $app->company_code }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Full Name') }}</div>
                    <div class="col-md-9">{{ $app->full_name }}</div>
                </div>
                <!--  -->
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Phone No') }}</div>
                    <div class="col-md-9">{{ $app->phone_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Emails') }}</div>
                    <div class="col-md-9">{{ $app->emails }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Website') }}</div>
                    <div class="col-md-9">{{ $app->website }}</div>
                </div>

                @if($app->domestic_or_foreign == 'Domestic')
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->a_geographic_location }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->a_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->a_postal_code }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Document No') }}</div>
                        <div class="col-md-9">{{ $app->c_document_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('First Name') }}</div>
                        <div class="col-md-9">{{ $app->c_first_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Last Name') }}</div>
                        <div class="col-md-9">{{ $app->c_last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Phone No') }}</div>
                        <div class="col-md-9">{{ $app->c_phone_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Mobile No') }}</div>
                        <div class="col-md-9">{{ $app->c_mobile_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->c_geographic_location }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->c_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->c_postal_code }}</div>
                    </div>
                @else
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Country') }}</div>
                        <div class="col-md-9">{{ $app->f_country }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->f_full_address }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    @if($exist_owner)
        <div class="tab-pane fade" id="nav-owner" role="tabpanel" aria-labelledby="nav-profile-tab">
            @foreach($application->drcProductOwners as $app)
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Domestic/Foreign') }}</div>
                    <div class="col-md-9">{{ $app->domestic_or_foreign }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Company Code') }}</div>
                    <div class="col-md-9">{{ $app->company_code }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Full Name') }}</div>
                    <div class="col-md-9">{{ $app->full_name }}</div>
                </div>
                <!--  -->
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Phone No') }}</div>
                    <div class="col-md-9">{{ $app->phone_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Fax No') }}</div>
                    <div class="col-md-9">{{ $app->fax_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Emails') }}</div>
                    <div class="col-md-9">{{ $app->emails }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Website') }}</div>
                    <div class="col-md-9">{{ $app->website }}</div>
                </div>
                @if($app->domestic_or_foreign == 'Domestic')
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->a_geographic_location }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->a_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->a_postal_code }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Document No') }}</div>
                        <div class="col-md-9">{{ $app->c_document_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('First Name') }}</div>
                        <div class="col-md-9">{{ $app->c_first_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Last Name') }}</div>
                        <div class="col-md-9">{{ $app->c_last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Phone No') }}</div>
                        <div class="col-md-9">{{ $app->c_phone_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Mobile No') }}</div>
                        <div class="col-md-9">{{ $app->c_mobile_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->c_geographic_location }}</div>
                    </div>
                @else
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->c_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->c_postal_code }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    @if($exist_end_product)
        <div class="tab-pane fade" id="nav-product" role="tabpanel" aria-labelledby="nav-contact-tab">
            @foreach($application->drcEndProducts as $app)
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Domestic/Foreign') }}</div>
                    <div class="col-md-9">{{ $app->domestic_or_foreign }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Company Code') }}</div>
                    <div class="col-md-9">{{ $app->company_code }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Full Name') }}</div>
                    <div class="col-md-9">{{ $app->full_name }}</div>
                </div>
                <!--  -->
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Phone No') }}</div>
                    <div class="col-md-9">{{ $app->phone_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Fax No') }}</div>
                    <div class="col-md-9">{{ $app->fax_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Emails') }}</div>
                    <div class="col-md-9">{{ $app->emails }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Website') }}</div>
                    <div class="col-md-9">{{ $app->website }}</div>
                </div>

                @if($app->domestic_or_foreign == 'Domestic')
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->a_geographic_location }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->a_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->a_postal_code }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Document No') }}</div>
                        <div class="col-md-9">{{ $app->c_document_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('First Name') }}</div>
                        <div class="col-md-9">{{ $app->c_first_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Last Name') }}</div>
                        <div class="col-md-9">{{ $app->c_last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Phone No') }}</div>
                        <div class="col-md-9">{{ $app->c_phone_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Mobile No') }}</div>
                        <div class="col-md-9">{{ $app->c_mobile_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->c_geographic_location }}</div>
                    </div>
                @else
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->c_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->c_postal_code }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    @if($exist_active_ingredient)
        <div class="tab-pane fade" id="nav-ingredient" role="tabpanel" aria-labelledby="nav-profile-tab">
            @foreach($application->drcActiveIngredients as $app)
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Domestic/Foreign') }}</div>
                    <div class="col-md-9">{{ $app->domestic_or_foreign }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Company Code') }}</div>
                    <div class="col-md-9">{{ $app->company_code }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Full Name') }}</div>
                    <div class="col-md-9">{{ $app->full_name }}</div>
                </div>
                <!--  -->
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Phone No') }}</div>
                    <div class="col-md-9">{{ $app->phone_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Fax No') }}</div>
                    <div class="col-md-9">{{ $app->fax_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Emails') }}</div>
                    <div class="col-md-9">{{ $app->emails }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Website') }}</div>
                    <div class="col-md-9">{{ $app->website }}</div>
                </div>

                @if($app->domestic_or_foreign == 'Domestic')
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->a_geographic_location }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->a_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->a_postal_code }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Document No') }}</div>
                        <div class="col-md-9">{{ $app->c_document_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('First Name') }}</div>
                        <div class="col-md-9">{{ $app->c_first_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Last Name') }}</div>
                        <div class="col-md-9">{{ $app->c_last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Phone No') }}</div>
                        <div class="col-md-9">{{ $app->c_phone_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Mobile No') }}</div>
                        <div class="col-md-9">{{ $app->c_mobile_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->c_geographic_location }}</div>
                    </div>
                @else
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->c_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->c_postal_code }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    @if($exist_other_ingredient)
        <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-contact-tab">
            @foreach($application->drcOtherIngredients as $app)
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Domestic/Foreign') }}</div>
                    <div class="col-md-9">{{ $app->domestic_or_foreign }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Company Code') }}</div>
                    <div class="col-md-9">{{ $app->company_code }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Full Name') }}</div>
                    <div class="col-md-9">{{ $app->full_name }}</div>
                </div>
                <!--  -->
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Phone No') }}</div>
                    <div class="col-md-9">{{ $app->phone_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Fax No') }}</div>
                    <div class="col-md-9">{{ $app->fax_number }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Emails') }}</div>
                    <div class="col-md-9">{{ $app->emails }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-3">{{ __('Website') }}</div>
                    <div class="col-md-9">{{ $app->website }}</div>
                </div>

                @if($app->domestic_or_foreign == 'Domestic')
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->a_geographic_location }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->a_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->a_postal_code }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Document No') }}</div>
                        <div class="col-md-9">{{ $app->c_document_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('First Name') }}</div>
                        <div class="col-md-9">{{ $app->c_first_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Last Name') }}</div>
                        <div class="col-md-9">{{ $app->c_last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Phone No') }}</div>
                        <div class="col-md-9">{{ $app->c_phone_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Mobile No') }}</div>
                        <div class="col-md-9">{{ $app->c_mobile_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Geographic Location') }}</div>
                        <div class="col-md-9">{{ $app->c_geographic_location }}</div>
                    </div>
                @else
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Full Address') }}</div>
                        <div class="col-md-9">{{ $app->c_full_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">{{ __('Postal Code') }}</div>
                        <div class="col-md-9">{{ $app->c_postal_code }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

@section('js')
    @parent
    <script>
        $(document).ready(function() {
            $('.nav-item:first-child').addClass('active');
            $('.tab-pane:first-child').addClass('show active');
        });
    </script>
@endsection










