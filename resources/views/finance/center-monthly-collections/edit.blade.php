@extends('layouts.default')

@php
    $page_title = 'Finance · Modifier un paiement mensuel';
@endphp

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Modifier le paiement mensuel</h4>
                </div>

                <form method="POST" action="{{ route('finance.center-monthly-collections.update', $collection) }}"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        @include('finance.center-monthly-collections._form', ['collection' => $collection])
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('finance.center-monthly-collections.index') }}" class="btn btn-light">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
