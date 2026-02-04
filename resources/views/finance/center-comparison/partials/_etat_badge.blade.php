{{-- 
    Badge renderer for etat_year status
    Expects: $etat (string)
    Renders: Bootstrap badge with appropriate color class
--}}

@php
    $badgeClass = match ($etat) {
        'Très bonne année (Record)' => 'badge-primary',
        'Nouveau chiffre attendu' => 'badge-info',
        'Mauvaise année' => 'badge-danger',
        'Normal' => 'badge-success',
        'À surveiller' => 'badge-warning',
        'Problème' => 'badge-danger',
        default => 'badge-secondary',
    };
@endphp

<span class="badge {{ $badgeClass }}">{{ $etat }}</span>
