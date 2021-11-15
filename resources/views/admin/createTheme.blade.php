@extends("admin/layouts.admin")

@section('content')


<h1 class="mt-4 mb-5 text-center">Create a new theme</h1>
@include('admin/error')

<div class="row">
    <div class="col-4 margin-top">
        <form action="{{ url('/') }}/admin" enctype="multipart/form-data" method="post">
        @csrf

          <div class="form-group m-4">
              <label for="name">Name</label>
              <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
              id="name" aria-describedby="name"
              value="{{ old('name') }}" required>
              @error('name')
              <div class="alert alert-danger" role="alert">
                  {{ $errors->first('name') }}
              </div>git
              @enderror
          </div>
          <div class="form-group m-4">
              <label for="image">Add an image</label>
              <input name="image" type="file" class="form-control-file" id="image">
              @error('image')
              <div class="alert alert-danger" role="alert">
                  {{ $errors->first('image') }}
              </div>
              @enderror
              <div id="imagePreview" class="image-preview">
                  <img scr="" class="image-preview__image">
                  <span class="image-preview__default-text">Image preview</span>
              </div>
          </div>
          <div class="form-group m-4">
              <label for="pdf">Add a pdf</label>
              <input name="pdf" type="file" class="form-control-file" id="pdf">
              @error('pdf')
              <div class="alert alert-danger" role="alert">
                  {{ $errors->first('pdf') }}
              </div>
              @enderror
          </div>
          <div class="form-group m-4">
              <label for="excerpt">Add an excerpt</label>
              <textarea name="excerpt" maxlength="{{ $characters }}" class="form-control @error('name') is-invalid @enderror"
              id="excerpt">
              {{ old('excerpt') }}
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
        <div class="col-6 margin-top">
           <div class="form-group m-4">
              <label for="description">Description</label>
              <textarea name="description" class="form-control @error('name') is-invalid @enderror"
              id="description" rows="3">
              {{ old('description') }}
              </textarea>
              @error('description')
              <div class="alert alert-danger" role="alert">
                  {{ $errors->first('description') }}
              </div>
              @enderror
          </div>
          <button type="submit" class="btn btn-primary float-right m-4">Create a theme</button>
        </div>
      </form>
      </div>
    </div>
@endsection
