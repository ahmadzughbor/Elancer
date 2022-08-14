<div class="form-group">
    <!-- <x-form.input id="name" name = "name" label="name" value = "{{ $role->name }}" /> -->
    <label for="name">name</label>
    <input type="text"id="name"name="name"value="{{ old('name', $role->name) }}"
        class="form-control form-control @error('name') is-invalid @enderror">
    @error('name')
        <p class="invalied-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    @foreach (config('abilities') as $ability => $label)
        <div class="form-check">
            <input class="form-check-input"  type="checkbox" value="{{$ability }}" name="abilities[]" id="flexRadioDefault1" @if(in_array($ability, $role->abilities ?? [])) checked  @endif>
            <label class="form-check-label" for="flexRadioDefault1">
                {{$label}}
            </label>
        </div>
    @endforeach
</div>

<div class="form-group">
    <button class="btn btn-primary">save</button>
</div>
