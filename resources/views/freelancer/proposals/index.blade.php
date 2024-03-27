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
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{__('Home')}}</a></li>
                                <li class="breadcrumb-item active">{{__('User Profile')}}</li>
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
                <h3 class="card-title">{{__('proposals')}}</h3>
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
                <table class="table table-striped proposals">
                    <thead>
                        <tr>
                            {{-- <th style="width: 1%">
                                #
                            </th> --}}
                            <th style="width: 20%">
                                {{__('proposal Name')}}
                            </th>
                            <th style="width: 8%" class="text-center">
                                {{__('Status')}}
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($proposals as $proposal)
                        <tr>
                            <td>
                                <a>
                                    {{$proposal->project->title}}
                                </a>
                                <br />
                                <small>
                                    {{$proposal->project->created_at}}
                                </small>
                            </td>
                            {{-- <td>
                                category : {{$proposal->category->parent->name}} / {{$proposal->category->name}}
                            </td> --}}
                            <td class="proposal_progress">
                            <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                    </div>
                                </div>

                            </td>
                            <td class="proposal-state">
                                <span class="badge badge-success">{{$proposal->status}}</span>
                            </td>
                            <td class="proposal-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    {{__('View')}}
                                </a>
                                <a class="btn btn-info btn-sm" href="{{route('freelancer.proposals.edit',['project' => $proposal->project->id ])}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    {{__('Edit')}}
                                </a>
                                @if($proposal->status == 'pending')
                                <a class="btn btn-danger btn-sm" href="{{route('freelancer.proposals.delete',['project' => $proposal->project->id ])}}">
                                    <i class="fas fa-trash">
                                    </i>
                                    {{__('Delete')}}
                                </a>
                                @endif
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


</x-front-layout>
