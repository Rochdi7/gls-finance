@extends('layouts.default')

@php
    $page_title = 'Créer un groupe';
@endphp

@section('content')
<div class="container-fluid">
    <div class="card">
        <form method="POST" action="{{ route('finance.groups.store') }}">
            @csrf
            <div class="card-body">
                @include('finance.groups._form')
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('finance.groups.index') }}" class="btn btn-danger light me-3">Annuler</a>
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection
