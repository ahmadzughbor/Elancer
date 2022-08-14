@extends('layouts.dashboard')
@section('page-title','create-roles')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $massege)
        <li>{{$massege}}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('roles.store')}}" method="post">
    @csrf
    @include('roles._form')
</form>
</div>
@endsection
