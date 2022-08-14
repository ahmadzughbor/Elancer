@props([
    'id'=>'','label','name','value'=>'','type'=>'text'
])
@if (isset($label))
<label for="{{$id}}">{{$label}}</label>
@endif
<input type="{{$type ?? 'text'}}"
    id="{{$id}}"
    name="{{$name}}"
    value="{{old($name,$value)}}"
    class="form-control form-control @error($name) is-invalid @enderror"/>
@error('name')
<p class="invalied-feedback">{{$message}}</p>
@enderror

