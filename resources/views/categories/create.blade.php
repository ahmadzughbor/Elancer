@extends('layouts.dashboard')
@section('page-title', 'create-categories')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $massege)
                    <li>{{ $massege }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        @include('categories._form')
    </form>
    </div>
@endsection
