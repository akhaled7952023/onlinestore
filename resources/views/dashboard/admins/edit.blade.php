@extends('layouts.dashboard.app')
@section('title')
    Edit Role
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a></li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.admins.index') }}">{{ __('dashboard.manage_users') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('dashboard.edit_role') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.edit_role') }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('dashboard.includes.validations-errors')
                            <form action="{{ route('dashboard.admins.update', $admin->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $admin->name }}">
                                <input type="hidden" name="email" value="{{ $admin->email }}">
                                <input type="hidden" name="password" value="{{ $admin->password }}">

                                <div class="form-body">
                                    <h4 class="form-section"><i class="la la-new"></i>{{ __('dashboard.edit_role') }}
                                    </h4>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.name') }}</label>
                                                <p class="form-control border-light bg-light">{{ $admin->name }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>{{ __('dashboard.email') }}</label>
                                                <p class="form-control border-light bg-light">{{ $admin->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">{{ __('dashboard.role_name') }}</label>
                                                <select id="type" name="type" class="form-control border-primary">
                                                    <option value="">{{ __('dashboard.choose_role') }}</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ $admin->type == $role->id ? 'selected' : '' }}>
                                                            {{ app()->getLocale() === 'ar' ? $role->name_ar : $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('dashboard.save') }}
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
