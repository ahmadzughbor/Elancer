<x-app-layout>
    <div style="
    margin-left: 5%;
">

    
    <form action="{{route('freelancer.proposals.store', $project->id)}}" method="post">
        @method('post')
        @csrf
        <h1>{{$project->title}} project</h1>
        <div class="form-group">
            <label for="cost">Cost</label>
            <input type="number" id="cost" name="cost" @if($proposal != null) value="{{$proposal->cost}}" @endif class="form-control @error('cost') is-invalid @enderror">
            @error('cost')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
            
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required> @if($proposal != null) {{$proposal->description}} @endif</textarea>
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="duration">Duration</label>
            <div class="input-group">
                <input type="number" min="1" name="duration" @if($proposal != null) value="{{$proposal->duration}}" @endif id="duration" class="form-control @error('duration') is-invalid @enderror">
                <div class="input-group-append">
                    <select id="duration_unit" name="duration_unit" class="form-control @error('duration_unit') is-invalid @enderror" required>
                        @foreach ($units as $key => $unit)
                        <option value="{{$key}}" @if($proposal != null) @if($proposal->duration_unit == $key ) selected @endif   @endif>{{$unit}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('duration')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
            @error('duration_unit')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    </div>
</x-app-layout>