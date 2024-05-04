@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $exception->getStatusCode() }}</div>

                    <div class="card-body">
                        @if($exception->getMessage())
                            {{ $exception->getMessage() }}
                        @else
                            {{ __('Sorry, the page you are looking for could not be found.') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection