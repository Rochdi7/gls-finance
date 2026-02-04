@extends('layouts.default')

@php
    $page_title = 'Finance · Ajouter un paiement mensuel';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Ajouter un paiement mensuel</h4>
                </div>

                <form method="POST" action="{{ route('finance.center-monthly-collections.store') }}" novalidate>
                    @csrf

                    <div class="card-body">
                        @include('finance.center-monthly-collections._form')
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('finance.center-monthly-collections.index') }}" class="btn btn-light">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Enregistrer
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
