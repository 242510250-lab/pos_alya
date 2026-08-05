@extends('layouts.app')

@section('tittle', 'Edit User')

@section('content')
<h4>Edit User</h4>

<form action="{{ Route('admin.users.update', $user) }}" method="">
    @include('users._form')
</form>
@endsection