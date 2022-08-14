@extends('layouts.dashboard')

@section('page-title')
roles<small><a href="{{ route('roles.create') }}" class="btn btn-sm btn-outline-primary">create</a>
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
                    <th>users  </th>
                    <th>created at</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td><a href="{{route('roles.show',['role'=>$role->id])}}"> {{ $role->name }} </a></td>
                    <td>{{ $role->users_count }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td><a href="{{route('roles.edit',['role'=>$role->id])}}" class="btn btn-sm btn-dark">edit</a> </td>
                    <td>
                        <form action="{{url('dashboard/roles/'.$role->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger">delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $roles->withQueryString()->links() }}
    @endsection
