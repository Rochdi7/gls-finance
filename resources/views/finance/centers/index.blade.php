@php
    $page_title = 'Centres';
@endphp

@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center mb-4 flex-wrap">
        <h3 class="me-auto">Liste des centres</h3>
        <div>
            <a href="{{ route('finance.centers.create') }}" class="btn btn-primary me-3">
                <i class="fas fa-plus me-2"></i>Ajouter un centre
            </a>
            <a href="javascript:void(0);" class="icon-btn me-3"> <i class="fas fa-envelope"></i></a>
            <a href="javascript:void(0);" class="icon-btn me-3"><i class="fas fa-phone-alt"></i></a>
            <a href="javascript:void(0);" class="icon-btn"><i class="fas fa-info"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            @include('finance.centers._table', ['centers' => $centers])
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Modal optionnel (même UI), adapté en FR --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Centre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-6  col-md-6 mb-4">
                        <label class="form-label required">Nom du centre</label>
                        <input type="text" class="form-control solid" placeholder="Nom" aria-label="name">
                    </div>

                    <div class="col-xl-6  col-md-6 mb-4">
                        <label class="form-label required">Ville</label>
                        <input type="text" class="form-control solid" placeholder="Ville" aria-label="city">
                    </div>

                    <div class="col-xl-12">
                        <label class="form-label me-3">Statut :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">Actif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">Inactif</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
@endpush
