@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Themes</h1>

@include('admin/error')

<div class="row">
    <div class="col-4">
    <h2>Edit the theme {{$theme->name}}</h2>
      <form action="" enctype="multipart/form-data" method="post">
      @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" value="{{$theme->name}}" class="form-control" id="name" aria-describedby="name">
        </div>
        <div class="form-group">
          <label for="image">Add an image</label>
          <input name="image" type="file" class="form-control-file" id="image">
          <div id="imagePreview" class="image-preview">
            <img scr="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" class="image-preview__image">
            <span class="image-preview__default-text">Image preview</span>
          </div>
        </div>
        <div class="form-group">
          <label for="pdf">Add a pdf</label>
          <input name="pdf" type="file" class="form-control-file" id="pdf">
        </div>
         <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control" id="description" rows="3">{{$theme->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Edit the theme</button>
      </form>
    </div>

</div>
@endsection
