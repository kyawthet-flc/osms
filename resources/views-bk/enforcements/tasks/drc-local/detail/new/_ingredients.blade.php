<x-utils.data-table class="table" :ths="['No.', 'Substance Name', 'Type', 'Quantity', 'Unit']">
    @foreach($application->drcIngredients as $indexer => $drcIngredient)
        <tr>
            <td>{{ $indexer + 1 }}.</td>
            <td>{{ $drcIngredient->substance_name }}</td>
            <td>{{ $drcIngredient->type }}</td>
            <td>{{ $drcIngredient->quantities }}</td>
            <td>{{ $drcIngredient->unit }}</td>
        </tr>
    @endforeach
</x-utils.data-table>
