@extends('layouts.dashboard')

@section('page-title')
{{-- @if(Auth::user()->can('categories.create')) --}}
@can('create', 'App/Models/Category')
categories<small><a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">create</a>
@endcan
    @endsection
    @section('bread')

    @endsection
    @section('content')

    <x-flash-message />
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name </th>
                    <th>slug </th>
                    <th>prrent id</th>
                    <th>created at</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td><a href="{{route('categories.show',['category'=>$category->id])}}"> {{ $category->name }} </a></td>
                    <td>{{ $category->slug }}</td>
                    <td>{{$category->parent_name}}</td>
                    <td>{{ $category->created_at }}</td>
                    {{-- @if(Gate::allows('categories.edit'))  --}}
                    @can('update',$category)
                    <td><a href="{{route('categories.edit',['category'=>$category->id])}}" class="btn btn-sm btn-dark">edit</a> </td>
                    @endcan
                    <td>
                        @can('delete',$category)
                        <form action="{{url('dashboard/categories/'.$category->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger">delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->withQueryString()->links() }}
    @endsection
