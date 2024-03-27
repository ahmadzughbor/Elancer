<x-app-layout >
    <!-- Main content -->
    <!-- <section class="content-header">
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
                </div>
            </section>
    <section class="content">
        <x-flash-message />
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
                          
                            <th style="width: 20%">
                                {{__('proposal Name')}}
                            </th>
                            <th >
                               Cost
                            </th>
                            <th >
                            Duration
                            </th>
                           
                           
                            <th  class="text-center">
                                {{__('Status')}}
                            </th>
                            <th >
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($projects as $project)
                        @foreach($project->proposals as $proposal)
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
                            <td>
                                {{$proposal->cost}}
                            </td> 
                            <td>
                            {{$proposal->duration }} {{$proposal->duration_unit }}
                            </td> 
                           
                       
                           
                            <td class="proposal-state text-center">
                                <span class="badge badge-success">{{$proposal->status}}</span>
                            </td>
                            <td class="proposal-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-binoculars" viewBox="0 0 16 16">
                                        <path d="M3 2.5A1.5 1.5 0 0 1 4.5 1h1A1.5 1.5 0 0 1 7 2.5V5h2V2.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5v2.382a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V14.5a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 14.5v-3a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5v3A1.5 1.5 0 0 1 5.5 16h-3A1.5 1.5 0 0 1 1 14.5V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882zM4.5 2a.5.5 0 0 0-.5.5V3h2v-.5a.5.5 0 0 0-.5-.5zM6 4H4v.882a1.5 1.5 0 0 1-.83 1.342l-.894.447A.5.5 0 0 0 2 7.118V13h4v-1.293l-.854-.853A.5.5 0 0 1 5 10.5v-1A1.5 1.5 0 0 1 6.5 8h3A1.5 1.5 0 0 1 11 9.5v1a.5.5 0 0 1-.146.354l-.854.853V13h4V7.118a.5.5 0 0 0-.276-.447l-.895-.447A1.5 1.5 0 0 1 12 4.882V4h-2v1.5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5zm4-1h2v-.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm4 11h-4v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zm-8 0H2v.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z" />
                                    </svg>
                                </a>
                               
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section> -->
    <section class="py-5 bg-primary py-5">
    <div class="container">
    @foreach($projects as $project)
        @foreach($project->proposals as $proposal)
            <div class="row mb-2">
                <div class="col-md-12">
                <a href="#" class="text-dark" style="text-decoration: none;">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-1 col-sm-2 col-md-1 mr-3">
                            <i class="fa fa-tachometer fa-4x "></i></br>
                            </div>
                            <div class="col-xs-8 col-sm-7 col-md-8">
                            <h5>{{$proposal->project->title}}</h5>
                            <span class="badge badge-warning py-1 mb-2"><strong>{{Currency::formatCurrency( $proposal->cost ,config('app.currency'))}}</strong></span>

                            <p>{{$proposal->description}}</p>

                            
                                <a href="#" class="btn btn-success">approved</a>
                                <a href="#"  class="btn btn-danger">rejeter</a>
                                <a href="#"  class="btn btn-info">chat</a>

                            
                            </div>
                            
                        </div>

                    </div>
                </div>
                </a>
                </div>
            </div>
        @endforeach
    @endforeach
       
    </div>
</section>



</x-front-layout>
