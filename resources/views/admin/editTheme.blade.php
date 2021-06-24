@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Themes</h1>

@include('admin/error')

<div class="row">
    <div class="col-4">
        <h2>Edit the theme <a href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">{{$theme->name}}</a></h2>
        <form action="" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" value="{{$theme->name}}" class="form-control" id="name" aria-describedby="name">
        </div>
        <div class="edit-image mb-5">
            <img src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" >
            <div class="edit-image__middle">
                <span class="edit-image__text">Change the picture</span>
            </div>
        </div>
        <div class="form-group upload">
          <label for="image">Choose a new image</label>
          <input name="image" type="file" class="form-control-file" id="image">
          <div id="imagePreview" class="image-preview">
            <img scr="" class="image-preview__image">
            <span class="image-preview__default-text">Image preview</span>
          </div>
        </div>
        <div class="edit-pdf">
            <a class="mb-5" href="{{ url('/') }}/storage/pdf/theme/{{$theme->pdf}}">{{$theme->pdf}}</a>
            <button class="btn btn-info edit-pdf__button">Change pdf</button>
        </div>
        <div class="form-group upload-pdf">
          <label for="pdf">Add a pdf</label>
          <input name="pdf" type="file" class="form-control-file" id="pdf">
        </div>
        <div class="form-group">
            <label for="excerpt">Add an excerpt</label>
            <textarea name="excerpt" maxlength="{{ $characters }}" class="form-control @error('name') is-invalid @enderror"
            id="excerpt">
            {{$theme->excerpt}}
            </textarea>
            <div id="the-count">
                <span id="current">0</span>
                <span id="maximum">/ {{ $characters }}</span>
            </div>
            @error('excerpt')
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('excerpt') }}
            </div>
            @enderror
        </div>
    </div>
    <div class="col-6">
         <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control" id="description" rows="3">{{$theme->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Edit the theme</button>
        </form>
    </div>

</div>
@endsection
