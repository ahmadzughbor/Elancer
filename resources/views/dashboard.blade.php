<x-front-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>
	
	<!-- <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    @foreach($recent_project as $project)
                    <div class="mx_auto m-5 ">
                    <a href="single-task-page.html" class="task-listing">

						<div class="task-listing-details">

							<div class="task-listing-description">
								<h3 class="task-listing-title">{{$project->title}}</h3>
								<ul class="task-icons">
									<li><i class="icon-material-outline-location-on"></i></li>
									<li><i class="icon-material-outline-access-time"></i> {{$project->created_at->diffForHumans()}}</li>
								</ul>
								<div class="task-tags margin-top-15">
                                    @foreach($project->tags as $tag)
									<span>{{$tag->name}}</span>
                                    @endforeach
								</div>
							</div>

						</div>

						<div class="task-listing-bid">
							<div class="task-listing-bid-inner">
								<div class="task-offers">
									<strong>{{Currency::formatCurrency( $project->budget ,config('app.currency'))}}</strong>
									<span>{{$project->type}}</span>
								</div>
								<span class="button button-sliding-icon ripple-effect">Bid Now <i class="icon-material-outline-arrow-right-alt"></i></span>
							</div>
						</div>
					</a>
                </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> -->
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<div class="d-flex flex-row justify-content-between align-items-center filters">
					<h6>Showing {{count($recent_project)}} tasks</h6>
					<div class="right-sort">
						<div class="sort-by"><span class="mr-1">Sort by:</span><a href="#">Most popular</a><i class="fa fa-angle-down ml-1"></i><button class="btn btn-outline-dark btn-sm ml-3 filter" type="button">Filters&nbsp;<i class="fa fa-flask"></i></button></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-1">
			@foreach($recent_project as $project)

			<div class="col-md-4 mt-1 mb-1 " >
				<a href="{{route('freelancer.proposals.edit',['project' => $project->id])}}" class="task-listing" style="text-decoration: none;">
					<div class="p-card bg-white p-2 rounded px-3" style="width: 100%;">
						<div class="d-flex align-items-center credits"><svg   version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 113.39 122.88" style=" width: 36px; height: 36px;  enable-background:new 0 0 113.39 122.88" xml:space="preserve">
								<g>
									<path d="M39.01,79.72c-1.38,0-2.49-1.33-2.49-2.97c0-1.64,1.12-2.97,2.49-2.97h13.63c1.38,0,2.49,1.33,2.49,2.97 c0,1.64-1.12,2.97-2.49,2.97H39.01L39.01,79.72z M85.66,67.41c7.66,0,14.59,3.1,19.61,8.12c5.02,5.02,8.12,11.95,8.12,19.61 s-3.1,14.59-8.12,19.61c-5.02,5.02-11.95,8.12-19.61,8.12s-14.59-3.1-19.61-8.12c-5.02-5.02-8.12-11.95-8.12-19.61 s3.1-14.59,8.12-19.61C71.07,70.51,78,67.41,85.66,67.41L85.66,67.41z M83.54,82.17c0-1.37,1.11-2.48,2.48-2.48 c1.37,0,2.48,1.11,2.48,2.48v12.92l9.66,5.72c1.18,0.69,1.57,2.21,0.87,3.39c-0.69,1.18-2.21,1.57-3.39,0.87L84.89,98.7 c-0.8-0.41-1.35-1.24-1.35-2.21V82.17L83.54,82.17z M101.77,79.04c-4.12-4.12-9.82-6.67-16.11-6.67c-6.29,0-11.99,2.55-16.11,6.67 c-4.12,4.12-6.67,9.82-6.67,16.11c0,6.29,2.55,11.99,6.67,16.11c4.12,4.12,9.82,6.67,16.11,6.67c6.29,0,11.99-2.55,16.11-6.67 c4.12-4.12,6.67-9.82,6.67-16.11S105.89,83.16,101.77,79.04L101.77,79.04z M44.1,109.94c1.64,0,2.97,1.33,2.97,2.97 c0,1.64-1.33,2.97-2.97,2.97H6.92c-1.9,0-3.63-0.78-4.89-2.03C0.78,112.6,0,110.87,0,108.97V6.92c0-1.91,0.78-3.63,2.03-4.89 C3.28,0.78,5.01,0,6.92,0h84.9c1.9,0,3.63,0.78,4.89,2.03c1.25,1.25,2.03,2.98,2.03,4.89V54.2c0,1.64-1.33,2.97-2.97,2.97 c-1.64,0-2.97-1.33-2.97-2.97V6.92c0-0.26-0.11-0.5-0.29-0.68c-0.18-0.18-0.42-0.29-0.68-0.29H6.92c-0.26,0-0.51,0.11-0.68,0.29 C6.05,6.41,5.94,6.65,5.94,6.92v102.05c0,0.26,0.11,0.51,0.29,0.68c0.18,0.18,0.42,0.29,0.68,0.29H44.1L44.1,109.94z M19.12,72.49 h7.45c0.54,0,0.98,0.44,0.98,0.98v7.45c0,0.54-0.44,0.98-0.98,0.98h-7.45c-0.54,0-0.98-0.44-0.98-0.98v-7.45 C18.15,72.92,18.59,72.49,19.12,72.49L19.12,72.49z M19.12,21.49h7.45c0.54,0,0.98,0.44,0.98,0.98v7.45c0,0.54-0.44,0.98-0.98,0.98 h-7.45c-0.54,0-0.98-0.44-0.98-0.98v-7.45C18.15,21.93,18.59,21.49,19.12,21.49L19.12,21.49z M39.01,28.72 c-1.38,0-2.49-1.33-2.49-2.97s1.12-2.97,2.49-2.97h35.46c1.38,0,2.49,1.33,2.49,2.97s-1.12,2.97-2.49,2.97H39.01L39.01,28.72z M22.17,56.14c-0.64,0.51-1.56,0.38-2.21-0.25c-0.07-0.05-0.14-0.11-0.21-0.18l-3.12-3.22c-0.65-0.68-0.5-1.81,0.34-2.53 c0.84-0.72,2.05-0.76,2.71-0.08l1.7,1.75l5.47-4.4c0.73-0.59,1.85-0.33,2.49,0.57c0.64,0.9,0.56,2.11-0.17,2.7L22.17,56.14 L22.17,56.14z M37.37,53.65c-1.38,0-2.49-1.33-2.49-2.97c0-1.64,1.12-2.97,2.49-2.97h35.46c1.38,0,2.49,1.33,2.49,2.97 c0,1.64-1.12,2.97-2.49,2.97H37.37L37.37,53.65z" />
								</g>
							</svg><span><b>{{$project->user->name}}</b></span></div>
						<h5 class="mt-2">{{$project->title}}</h5><span class="badge badge-danger py-1 mb-2">{{$project->status}}</span>
						<span class="badge badge-primary py-1 mb-2">{{$project->type}}</span>
						<span class="badge badge-warning py-1 mb-2"><strong>{{Currency::formatCurrency( $project->budget ,config('app.currency'))}}</strong></span>
						<span class="d-block mb-5">{{$project->description}}</span>
						<div class="d-flex justify-content-between stats">
							<div><i class="fa fa-calendar-o"></i><span class="ml-2">{{$project->created_at->diffForHumans()}}</span></div>
							<div class="d-flex flex-row align-items-center">
								<div class="profiles">
									@foreach($project->proposedFreelancers as $user)
									
									<img class="rounded-circle" src="{{$user->getProfilePhotoUrlAttribute()}}" width="30">
									
									@endforeach
								</div><span class="ml-3">{{count($project->proposedFreelancers)}}</span>
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach


		</div>
		<div class="mt-2">

			{{ $recent_project->links() }}
		</div>
		<!-- <div class="d-flex justify-content-end text-right mt-2">
			<nav>
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">4</a></li>
					<li class="page-item"><a class="page-link" href="#">5</a></li>
					<li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
				</ul>
			</nav>
		</div> -->
	</div>
</x-front-layout>