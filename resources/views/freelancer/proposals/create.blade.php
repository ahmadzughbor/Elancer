<x-app-layout>
<form action="{{route('freelancer.proposals.store', $project->id)}}" method="post">
    @csrf
    <h1>{{$project->title}} project</h1>
    <div class="form-group">
        <label for="name">cost</label>
    <input type="number"id="cost"name="cost" class="form-control form-control @error('cost') is-invalid @enderror">
    @error('cost')
    <p class="invalied-feedback">{{$message}}</p>
    @enderror
    <div class="form-group">
        <label for="description">description</label>
        <textarea name="description" id="description" class="form-control form-control @error('description') is-invalid @enderror" required > </textarea>
        @error('description')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
        <label for="duration">duration</label>
        <input type="number" min="1" name="duration" id="duration" class="form-control form-control @error('duration') is-invalid @enderror">
        @error('duration')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
        <select id="duration_unit" name="duration_unit" class="form-control form-control @error('duration_unit') is-invalid @enderror" required>
            @foreach ($units as $key=> $unit)
            <option value="{{$key}}">{{$unit}}</option>
            @endforeach
        </select>

    </div>
    <div class="form-group">
        <button class="btn btn-primary">save</button>
    </div>
</form>
</x-app-layout>
