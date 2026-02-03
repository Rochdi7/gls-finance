@extends('layouts.default')

@php
    $page_title = 'Groupes';
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4 flex-wrap">
        <h3 class="me-auto">Liste des groupes</h3>
        <div>
            <a href="{{ route('finance.groups.create') }}" class="btn btn-primary me-3">
                <i class="fas fa-plus me-2"></i>Ajouter un groupe
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            @include('finance.groups._table', ['groups' => $groups])
        </div>
    </div>
</div>
@endsection
