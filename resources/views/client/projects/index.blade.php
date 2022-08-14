<x-app-layout >
    <!-- Main content -->
    <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
    <section class="content">
        <x-flash-message />
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Projects</h3>
                <a href="{{route('client.projects.create')}}" class="fas fa-pencil-alt" style="margin-left: 20px">create project</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Project Name
                            </th>
                            <th style="width: 30%">
                                category tybe
                            </th>
                            <th>
                                Project Progress
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($projects as $project)
                        <tr>
                            <td>
                                #
                            </td>
                            <td>
                                <a>
                                    {{$project->title}}
                                </a>
                                <br />
                                <small>
                                    {{$project->created_at}}
                                </small>
                            </td>
                            <td>
                                {{-- category : {{$project->category->parent->name}} / {{$project->category->name}} --}}
                            </td>
                            <td class="project_progress">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                    </div>
                                </div>

                            </td>
                            <td class="project-state">
                                <span class="badge badge-success">{{$project->status}}</span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('client.projects.edit',$project->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form action="{{route('client.projects.destroy',$project->id)}}" method="post">
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->


</x-app-layout>
