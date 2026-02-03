<div class="table-responsive">
    <table class="table display mb-4 dataTablesCard card-table" id="example6">
        <thead>
            <tr>
                <th>#</th>
                <th>Centre</th>
                <th>Mois</th>
                <th>Étudiants</th>
                <th>Revenu total</th>
                <th>Propriétaire (50%)</th>
                <th>Professeurs (35%)</th>
                <th>Charges (15%)</th>
                <th>Type</th>
                <th>Statut</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rows as $i => $row)
                <tr>
                    <td>{{ ($rows->firstItem() ?? 0) + $i }}</td>

                    <td>{{ $row->center->name }}</td>

                    <td>
                        {{ str_pad($row->month, 2, '0', STR_PAD_LEFT) }}/{{ $row->year }}
                    </td>

                    <td>{{ $row->total_students }}</td>

                    <td>
                        <strong>{{ number_format($row->total_revenue) }} DH</strong>
                    </td>

                    <td>{{ number_format($row->owner_share_50) }} DH</td>
                    <td>{{ number_format($row->professors_share_35) }} DH</td>
                    <td>{{ number_format($row->other_costs_15) }} DH</td>

                    <td>
                        @if ($row->is_historical)
                            <span class="badge badge-info light">Historique</span>
                        @else
                            <span class="badge badge-success light">Live</span>
                        @endif
                    </td>

                    <td>
                        @if ($row->locked)
                            <span class="badge badge-danger light">Verrouillé</span>
                        @else
                            <span class="badge badge-success light">Ouvert</span>
                        @endif
                    </td>

                    {{-- ✅ ACTIONS --}}
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">

                            {{-- 👁️ Voir --}}
                            <a href="{{ route('finance.monthly-financials.show', $row) }}"
                               class="btn btn-secondary light btn-sm"
                               title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if (!$row->locked)
                                {{-- ✏️ Modifier --}}
                                <a href="{{ route('finance.monthly-financials.edit', $row) }}"
                                   class="btn btn-info light btn-sm"
                                   title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- 🗑️ Supprimer --}}
                                <form method="POST"
                                      action="{{ route('finance.monthly-financials.destroy', $row) }}"
                                      onsubmit="return confirm('Confirmer la suppression de ce mois ?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger light btn-sm"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center py-4">
                        Aucune donnée financière disponible.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if (method_exists($rows, 'links'))
    <div class="d-flex justify-content-end">
        {{-- ✅ IMPORTANT: pagination Bootstrap 5 (compatible thème) --}}
        {{ $rows->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ✅ Empêche le conflit DataTables (thème) vs pagination Laravel
    if (!window.jQuery || !jQuery.fn.DataTable) return;

    if (jQuery.fn.DataTable.isDataTable('#example6')) {
        jQuery('#example6').DataTable().destroy();
    }

    jQuery('#example6').DataTable({
        paging: false,
        info: false,
        searching: false,
        lengthChange: false
    });
});
</script>
@endpush
