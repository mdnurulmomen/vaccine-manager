@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Check Vaccine Status') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('search') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nid" class="col-md-4 col-form-label text-md-end">{{ __('Your NID') }}</label>

                            <div class="col-md-6">
                                <input id="nid" type="text" class="form-control" name="nid" value="{{ old('nid') }}" required autocomplete="nid" autofocus>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    @error('nid')
                        <button type="button" class="btn btn-danger">
                            {{ __('Unregistered') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('register') }}">
                            {{ __('Get Registered Now') }}
                        </a>
                    @enderror

                    @session('user')
                        @php($user = session('user'))

                        Hello {{ $user['name'] }}, You're

                        @if(empty($user['vaccine']))
                            <button type="button" class="btn btn-warning">
                                {{ __('Unscheduled') }}
                            </button>

                        @elseif ($user['vaccine']['is_completed']==1)
                            <button type="button" class="btn btn-success">
                                {{ __('Vaccinated') }}
                            </button>

                        @elseif ($user['vaccine']['schedule'] > today())
                            <button type="button" class="btn btn-info">
                                {{ __('Scheduled') }}
                            </button>
                            <p>
                                Your schedule is at: {{ $user['vaccine']['schedule']->format('Y-m-d') }}
                            </p>

                        @elseif ($user['vaccine']['schedule'] < today() && $user['vaccine']['is_completed']==0)
                            <button type="button" class="btn btn-danger">
                                {{ __('out of time') }}
                            </button>
                        @endif
                    @endsession
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
