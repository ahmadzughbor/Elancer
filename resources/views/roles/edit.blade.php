@extends('layouts.dashboard')
@section('page-title','edit-roles')
@section('content')

    <div class="continer">
        <form action="{{route('roles.update',['role'=>$role->id])}}" method="post">
            @csrf
            @method('put')
            @include('roles._form')
        </form>
    </div>
@endsection
