    <!-- Main content -->
    <section class="content" style="margin-left: 28%">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">General</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">title</label>
                            <input type="text" name="title" id="title" value="{{old('title',$project->title)}}"   class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                            <p class="invalied-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="budget">budget</label>
                            <input type="text" name="budget" id="budget" value="{{old('budget',$project->budget)}}" class="form-control  @error('budget') is-invalid @enderror">
                            @error('budget')
                            <p class="invalied-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tags">tags</label>
                            <input type="text" name="tags" id="tags" value="{{implode(',', $tags)}}" class="form-control  ">
                        </div>
                        <div class="form-group">
                            <input type="file" name="attachments[]" id="file"  class="form-control button-input" multiple>
                        </div>
                        <div class="form-group">
                            <label for="description">Project Description</label>
                            <textarea id="description" name="description" class="form-control  @error('description') is-invalid @enderror" rows="4">{{old('description',$project->description)}}</textarea>
                            @error('description')
                            <p class="invalied-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="types">types</label>
                            <select id="types" name="type" class="form-control custom-select">

                                @foreach ($types as $type)
                                <option value="{{$type}}" @if($type == old( 'type', $project->type)) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Status">Status</label>
                            <select id="Status" name="status" class="form-control custom-select">

                                @foreach ($status as $stat)
                                <option value="{{$stat}}" @if($stat ==old('status', $project->status(''))) selected @endif>{{$stat}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Status</label>
                            <select id="category_id" name="category_id" class="form-control custom-select">

                                @foreach ($categories as $key=> $category)
                                <option value="{{$key}}"  @if($key == old( 'category_id',$key)) selected @endif>{{$category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Project" class="btn btn-success float-right">
            </div>
        </div>
    </section>
    <!-- /.content -->
