@extends('layouts.default')

@php
    $page_title = 'Ajouter une finance mensuelle';
@endphp

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h3>Nouvelle finance mensuelle (historique)</h3>
    </div>

    <form method="POST" action="{{ route('finance.monthly-financials.store') }}">
        @include('finance.monthly-financials._form', ['monthly' => null])

        <div class="text-end mt-4">
            <a href="{{ route('finance.monthly-financials.index') }}"
               class="btn btn-danger light me-3">
                Annuler
            </a>
            <button type="submit" class="btn btn-primary">
                Enregistrer
            </button>
        </div>
    </form>

</div>
@endsection
