@extends('layouts.dashboard')

@section('page-title')
    {{-- @if (Auth::user()->can('categories.create')) --}}
    @can('create', 'App/Models/Category')
        categories<small><button href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary ml-3"
                id="create">create</button>
        @endcan
    @endsection
    @section('bread')
    @endsection
    @section('content')
        <x-flash-message />
        <div id="table">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                        <tr id="tr{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <td><a href="{{ route('categories.show', ['category' => $category->id]) }}">
                                    {{ $category->name }}
                                </a></td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent_name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>

                                <a class="edit btn btn-sm btn-dark"
                                    href="{{ route('categories.update', ['category' => $category->id]) }}"
                                    id="{{ $category->id }}">Edit</a>
                            </td>
                            <td>
                                @can('delete', $category)
                                    <form action="{{ url('dashboard/categories/' . $category->id) }}" method="post">
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


        <div class="modal" tabindex="-1" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" id="close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="" method="" id="formData" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('post') --}}
                        <div class="m-5">
                            <div class="form-group">
                                <!-- <x-form.input id="name" name = "name" label="name" value = "{{ $category->name }}" /> -->
                                <label for="name">name</label>
                                <input type="text"id="name"name="name"value="{{ old('name', $category->name) }}"
                                    class="form-control form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <p class="invalied-feedback">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="form-group">
                                <!-- <x-form.inputs name = "parent_id" :options ="$parents->pluck('name')" id ="parent_id" label="parent" :select = "$category->parent_id"/> -->
                                <label for="parent_id">parent</label>
                                <select id="parent_id" name="parent_id"
                                    class="form-control form-control @error('parent_id') is-invalid @enderror
                                {{ old('parent_id', $category->parent_id) }}">
                                    <option value=""></option>
                                    @foreach ($parent as $parent)
                                        <option value="{{ $parent->id }}"
                                            @if ($parent->id == old($parent->id, $category->parent_id)) selected @endif>
                                            {{ $parent->name }} </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">description</label>
                                <textarea name="description" id="description"
                                    class="form-control form-control @error('description') is-invalid @enderror"> {{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                                <label for="slug">slug</label>
                                <textarea name="slug" id="slug" class="form-control form-control @error('slug') is-invalid @enderror"> {{ old('slug', $category->slug) }}</textarea>
                                @error('slug')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="art_file">art file</label>
                                <input type="file" id="art_file" name="art_file "
                                    class="form-control @error('art_file') is-invalid @enderror ">
                                @error('art_file')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" id="save">save</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
            integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
        </script>
        <script>
            $(function() {
                /*------------------------------------------
                 --------------------------------------------
                 Pass Header Token
                 --------------------------------------------
                 --------------------------------------------*/
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
            $(document).on('click', '#create', function(e) {
                e.preventDefault();
                // $('#modal')[0].reset();
                $('#slug').val('');
                $('#description').val('');
                $('#name').val('');
                $('#parent_id').val('');
                $('#modal').show();
                $('#formData').attr('action', "{{ route('categories.store') }}");
                $('#formData').attr('method', 'post');
            });
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                var urlEdit = $(this).attr('href');
                $('#formData').attr('action', urlEdit);
                $('#formData').attr('method', 'post');
                var id = $(this).attr('id');
                var url = "{{ route('getById', ['category' => 'category']) }}".replace('category',  id);

                debugger;
                $.ajax({
                    type: 'post',
                    url: url,
                    success: function(data) {
                        $('#name').val(data.name);
                        $('#slug').val(data.slug);
                        $('#description').val(data.description);
                        $('#parent_id').val(data.parent_id);
                        toastr.success('Done')

                    },
                    error: function(data) {
                        // alert("error");
                        toastr.error('error')

                    },
                });
                $('#modal').show();
            });

            $(document).on('click', '#close', function(e) {
                e.preventDefault();
                $('#modal').hide();
            });

            $("#save").click(function(e) {
                        e.preventDefault();
                        // var formData = $('#formData').serialize();
                        var formData = new FormData($("#formData")[0]);
                        var url = $('#formData').attr('action');
                        var method = $('#formData').attr('method');
                        debugger;
                        $.ajax({
                                type: method,
                                url: url,
                                enctype: 'multipart/form-data',
                                // dataType : 'json',
                                data: formData,
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function(data) {
                                    $('#modal').hide();
                                    if (data.type == 1) {
                                        const html = generateElement(data);
                                        $('#body').append(html)
                                    } else if (data.type == 2) {
                                        // $("tr" + data.id).replaceWith("");
                                        }
                                        toastr.success('Saved')

                                        // alert('done');
                                    },
                                    error: function(data) {
                                        // alert('error');
                                        toastr.error('Error')

                                        // let response = JSON.parse(data.responseText);
                                        // $.each(response.errors, function(field_name, error) {
                                        //     $("#" + field_name + "_error").text(error[0]);
                                        // });
                                    },
                                });
                        });
        </script>
    @endsection
