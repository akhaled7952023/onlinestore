@extends('layouts.dashboard.app')
@section('title')
    {{ __('dashboard.edit_profile') }}
@endsection
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('dashboard.edit_profile') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('dashboard.edit_profile') }}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        @include('dashboard.includes.validations-errors')
                        <form action="{{ route('dashboard.admins.profile.update', $admin->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-user"></i>{{ __('dashboard.edit_profile') }}</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.admin_name') }}</label>
                                            <input type="text" class="form-control border-primary" name="name" value="{{ $admin->name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.admin_email') }}</label>
                                            <input type="email" class="form-control border-primary" name="email" value="{{ $admin->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" id="toggle-password-btn" onclick="togglePassword()">
                                            {{ __('dashboard.change_password') }}
                                        </button>
                                        <div class="form-group" id="password-container" style="padding-top: 20px">
                                            <input type="password" hidden class="form-control border-primary" name="password" placeholder="{{ __('dashboard.password') }}" autocomplete="new-password">
                                            <input type="password" hidden class="form-control border-primary mt-2" name="password_confirmation" placeholder="{{ __('dashboard.confirm_password') }}" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordField = document.querySelector('input[name="password"]');
    const confirmField = document.querySelector('input[name="password_confirmation"]');
    const toggleButton = document.getElementById('toggle-password-btn');

    if (passwordField.hasAttribute('hidden')) {
        passwordField.removeAttribute('hidden');
        confirmField.removeAttribute('hidden');
        toggleButton.textContent = "{{ __('dashboard.cancel_password_change') }}";
    } else {
        passwordField.setAttribute('hidden', '');
        confirmField.setAttribute('hidden', '');
        toggleButton.textContent = "{{ __('dashboard.change_password') }}";
        passwordField.value = '';
        confirmField.value = '';
    }
}
</script>
@endsection
