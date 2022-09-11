@extends('spum::layouts.app')

@section('content')
    @include('spum::roles._form', ['url' => route('roles.store')])
@endsection
