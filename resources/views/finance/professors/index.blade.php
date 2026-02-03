@extends('layouts.default')

@php
    $page_title = 'Professeurs';
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4 flex-wrap">
        <h3 class="me-auto">Liste des professeurs</h3>
        <div>
            <a href="{{ route('finance.professors.create') }}" class="btn btn-primary me-3">
                <i class="fas fa-plus me-2"></i>Ajouter un professeur
            </a>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-envelope"></i></a>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-phone-alt"></i></a>
            <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            @include('finance.professors._table', ['professors' => $professors])
        </div>
    </div>
</div>
@endsection
