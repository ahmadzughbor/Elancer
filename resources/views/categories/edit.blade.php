@extends('layouts.dashboard')
@section('page-title','edit-categories')
@section('content')

    <div class="continer">
        <form action="{{route('categories.update',['category'=>$category->id])}}" method="post">
            @csrf
            @method('put')
            @include('categories._form')
        </form>
    </div>
@endsection
