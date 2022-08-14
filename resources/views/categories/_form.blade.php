<div class="form-group">
    <!-- <x-form.input id="name" name = "name" label="name" value = "{{$category->name}}" /> -->
    <label for="name">name</label>
<input type="text"id="name"name="name"value="{{old('name',$category->name)}}" class="form-control form-control @error('name') is-invalid @enderror">
@error('name')
<p class="invalied-feedback">{{$message}}</p>
@enderror

</div>
<div class="form-group">
    <!-- <x-form.inputs name = "parent_id" :options ="$parents->pluck('name')" id ="parent_id" label="parent" :select = "$category->parent_id"/> -->
    <label for="parent_id">parent</label>
<select id="parent_id" name="parent_id" class="form-control form-control @error('parent_id') is-invalid @enderror"> {{old('parent_id',$category->parent_id)}}">
    <option value=""></option>
    @foreach ($parents as $parent)
    <option value="{{ $parent->id}}" @if($parent->id == old($parent->id, $category->parent_id)) selected @endif> {{$parent->name}} </option>
    @endforeach
</select>
@error('parent_id')
<p class="invalid-feedback"> {{$message}} </p>
@enderror
</div>
<div class="form-group">
    <label for="description">description</label>
    <textarea name="description" id="description" class="form-control form-control @error('description') is-invalid @enderror"> {{old('description',$category->description)}}</textarea>
    @error('description')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
    <label for="slug">slug</label>
    <textarea name="slug" id="slug" class="form-control form-control @error('slug') is-invalid @enderror"> {{old('slug',$category->slug)}}</textarea>
    @error('slug')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    <label for="art_file">art file</label>
    <input type="file" id="art_file" name="art_file " class="form-control @error('art_file') is-invalid @enderror ">
    @error('art_file')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    <button class="btn btn-primary" id="save">save</button>

</div>

