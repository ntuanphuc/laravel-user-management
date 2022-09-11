@extends('spum::layouts.app')

@section('content')
    @include('spum::roles._form', ['url' => route('roles.update', ['role' => $role->id])])
@endsection
