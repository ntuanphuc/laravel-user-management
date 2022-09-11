@extends('spum::layouts.app')

@section('content')
    @include('spum::users._form', ['url' => route('users.store')])
@endsection
