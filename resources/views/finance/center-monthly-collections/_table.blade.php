<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Centre</th>
            <th>Année</th>
            <th>Mois</th>
            <th>Espèces</th>
            <th>TPE</th>
            <th>Virement</th>
            <th>Chèque</th>
            <th>Total</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($collections as $row)
            <tr>
                <td>{{ $row->center->name }}</td>
                <td>{{ $row->year }}</td>
                <td>{{ $row->month }}</td>
                <td>{{ number_format($row->cash_amount, 2) }}</td>
                <td>{{ number_format($row->tpe_amount, 2) }}</td>
                <td>{{ number_format($row->bank_transfer_amount, 2) }}</td>
                <td>{{ number_format($row->cheque_amount, 2) }}</td>
                <td class="fw-bold">{{ number_format($row->total_amount, 2) }}</td>
                <td class="text-end">
                    <a href="{{ route('finance.center-monthly-collections.edit', $row) }}"
                        class="btn btn-sm btn-primary">Modifier</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted">
                    Aucune donnée trouvée
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $collections->links() }}
