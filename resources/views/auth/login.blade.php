@extends('layouts.fullwidth')

@section('content')
<div class="col-lg-5 col-md-6">
    <div class="card mb-0 h-auto">
        <div class="card-body">
            <div class="text-center mb-3">
                <a href="#">
                    <img class="logo-auth" src="{{ asset('assets/images/logo/gls-noir.png') }}" alt="GLS">
                </a>
            </div>

            <h4 class="text-center mb-4">GLS Portail</h4>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group mb-4">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="admin@gls.local"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                {{-- Password --}}
                <div class="mb-sm-4 mb-3 position-relative">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >
                    <span class="show-pass eye">
                        <i class="fa fa-eye-slash"></i>
                        <i class="fa fa-eye"></i>
                    </span>
                </div>

                {{-- Remember --}}
                <div class="form-row d-flex justify-content-between mb-3">
                    <div class="form-check ms-1">
                        <input
                            type="checkbox"
                            name="remember"
                            class="form-check-input"
                            id="remember"
                        >
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        Sign In
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
