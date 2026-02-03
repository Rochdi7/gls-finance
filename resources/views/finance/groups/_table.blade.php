<div class="table-responsive">
    <table class="table display mb-4 dataTablesCard job-table table-responsive-xl card-table" id="example5">
        <thead>
            <tr>
                <th>#</th>
                <th>Centre</th>
                <th>Professeur</th>
                <th>Niveau</th>
                <th>Mois / Année</th>
                <th>Étudiants</th>
                <th>Prix</th>
                <th>Revenu</th>
                <th>Rétention</th>
                <th>Statut</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($groups as $i => $group)
                <tr>
                    <td>{{ ($groups->firstItem() ?? 0) + $i }}</td>
                    <td>{{ $group->center->name }}</td>
                    <td>{{ $group->professor->name }}</td>
                    <td><strong>{{ $group->level_code }}</strong></td>
                    <td>{{ str_pad($group->month, 2, '0', STR_PAD_LEFT) }}/{{ $group->year }}</td>
                    <td>{{ $group->students_start_count }} → {{ $group->students_end_count }}</td>
                    <td>{{ number_format($group->price_per_student) }} DH</td>
                    <td><strong>{{ number_format($group->revenue()) }} DH</strong></td>
                    <td>{{ $group->retentionPercent() }} %</td>
                    <td>
                        @if ($group->status === 'active')
                            <span class="badge badge-success light">Actif</span>
                        @else
                            <span class="badge badge-secondary light">Terminé</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons d-flex justify-content-end">
                            <a href="{{ route('finance.groups.edit', $group) }}" class="btn btn-secondary light me-2">
                                ✏️
                            </a>
                            <form method="POST" action="{{ route('finance.groups.destroy', $group) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger light"
                                    onclick="return confirm('Confirmer la suppression du groupe ?')">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center py-4">
                        Aucun groupe enregistré.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if (method_exists($groups, 'links'))
    <div class="d-flex justify-content-end">
        {{-- ✅ IMPORTANT: pagination Bootstrap 5 (compatible thème) --}}
        {{ $groups->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ✅ Le thème initialise souvent DataTables automatiquement.
    // On évite le conflit avec la pagination Laravel en désactivant paging/info/search.
    if (!window.jQuery || !jQuery.fn.DataTable) return;

    if (jQuery.fn.DataTable.isDataTable('#example5')) {
        jQuery('#example5').DataTable().destroy();
    }

    jQuery('#example5').DataTable({
        paging: false,
        info: false,
        searching: false,
        lengthChange: false
    });
});
</script>
@endpush
