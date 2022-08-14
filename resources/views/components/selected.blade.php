<div class="form-group">
    <x-form.input name="name" id="name" value="{{$category->name}}" label="name" />
</div>
<div class="form-group">
</div>
<div class="form-group">
    <label for="description">description</label>
    <textarea name="description" id="description" class="form-control form-control @error('description') is-invalid @enderror"> {{old('description',$category->description)}}</textarea>
    @error('description')
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
    <button class="btn btn-primary">save</button>
</div>
