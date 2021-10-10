<div class="row mb-4 responsive">
<?php
   $cols = [
       'No.',
       'Brand Name', 
       'Generic Name', 
       'Dosage Form',
       'Presentation', 
       'Manufacturing',
       'Distributor',
       'Manufacturing Country',
       'Myanmar Drug Registration No.', 
       'Sale Category',
       'Storage Condition',
       'Action'
    ];
    $shouldDisplayDrugToImportApprove = in_array($application->application_type,['new', 'renew']) || ($application->application_type == 'amend' && $application->has_extension == 'yes');
   
?>

<x-utils.data-table class="table" :ths="$cols">
   
    @foreach ($application->drugsToBeImported as $k => $drugToBeImported)
        <tr>
            <td>{{ $k + 1 }}.</td>

            <td>{{ $drugToBeImported->brand_name }}</td>
            <td>{{ $drugToBeImported->generic_name }}</td>
            <td>{{ $drugToBeImported->dosage_form }}</td>
            <td>{{ $drugToBeImported->presentation }}</td>
            <td>{{ $drugToBeImported->manufacturing }}</td>
            <td>{{ $drugToBeImported->distributor }}</td>
            <td>{{ $drugToBeImported->manufacturing_country }}</td>
            <td>{{ $drugToBeImported->mm_drug_reg_no }}</td>
            <td>{{ $drugToBeImported->sale_category }}</td>
            <td>{{ $drugToBeImported->storage_condition }}</td>
            <td>
                @if( $shouldDisplayDrugToImportApprove )
                <label for="is-selected-{{ $drugToBeImported->id }}">
                    <input 
                    @if($drugToBeImported->is_selected=='yes') checked="checked" @endif
                    list-action-url="{{ route('tasks.diac.toggle_approve_list',[
                        'diacApplication' => $application,
                        'diacDrugToImport' => $drugToBeImported]
                        ) }}" type="checkbox" drug-to-import="drug-to-import" id="is-selected-{{ $drugToBeImported->id }}" />
                        <span style="font-size: 12px;color: #222;">To Approve
                    </span>
                </label>
                @else
                <label for="disabled">
                    <input type="checkbox" disabled="disabled" id="disabled" />
                    <span style="font-size: 12px;color: #777;">To Approve</span>
                </label>                  
                @endif
            </td>       
        </tr>
    @endforeach

</x-utils.data-table> 

</div>