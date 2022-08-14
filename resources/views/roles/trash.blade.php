@extends('layouts.dashboard')

@section('page-title')
    deleted categories<small><a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">create</a>
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
                        <th>parent id</th>
                        <th>deleted at</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td><a href="{{ route('categories.show', ['category' => $category->id]) }}"> {{ $category->name }}
                                </a></td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent->name }}</td>
                            <td>{{ $category->deleted_at }}</td>
                            <td>
                                <form action="{{  route('categories.restore',$category->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-sm btn-info">restore</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{  route('categories.forceDeleted',$category->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger">delete forever</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->withQueryString()->links() }}
    @endsection
