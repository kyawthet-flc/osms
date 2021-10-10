<div class="row mb-2">
    <div class="col-md-3 mb-2">{{ __('Type of Drug') }}</div>
    <div class="col-md-9 mb-2">
       {{ optional($application->dlmcDrugsToProduce)->type_of_drug }}
    </div>
    <div class="col-md-3 mb-2">{{ __('Dosage Form Type') }}</div>
    <div class="col-md-9 mb-2">
       {{ optional($application->dlmcDrugsToProduce)->dosage_type }}
    </div>
    <div class="col-md-3 mb-2">{{ __('Dosage Form') }}</div>
    <div class="col-md-9 mb-2">
        @php
            $dosageDatas =  json_decode(optional($application->dlmcDrugsToProduce)->dosage_form);
        @endphp
        @foreach ($dosageDatas as $id)
            @php
                $dosageData =  App\Model\GeneralSetup\DlmcDosageForm::where('id', $id)->first();
                $chileDatas = App\Model\GeneralSetup\DlmcDosageForm::where('parent_id', $id)->get();
            @endphp
            {{ $dosageData->name }}
            @foreach ($chileDatas as $chileData)
                <li>
                    {{ $chileData->name }}
                </li>
            @endforeach 
            <br>
        @endforeach
    </div>
</div>

