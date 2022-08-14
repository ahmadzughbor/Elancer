<x-front-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($recent_project as $project)
                    <a href="single-task-page.html" class="task-listing">

						<!-- Job Listing Details -->
						<div class="task-listing-details">

							<!-- Details -->
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
