@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Themes</h1>

@include('admin/error')

<div class="row">
    <div class="col-4">
    <h2>Create a theme</h2>
      <form action="{{ url('/') }}/admin" enctype="multipart/form-data" method="post">
      @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input name="name" type="text" class="form-control" id="name" aria-describedby="name">
        </div>
        <div class="form-group">
          <label for="image">Add an image</label>
          <input name="image" type="file" class="form-control-file" id="image">
          <div id="imagePreview" class="image-preview">
            <img scr="" class="image-preview__image">
            <span class="image-preview__default-text">Image preview</span>
          </div>
        </div>
        <div class="form-group">
          <label for="pdf">Add a pdf</label>
          <input name="pdf" type="file" class="form-control-file" id="pdf">
        </div>
         <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create a theme</button>
      </form>
    </div>
    <div class="col-5 offset-md-1">
        <h2>List of themes</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Thumbnail</th>
              <th scope="col">Name</th>
              <th scope="col">PDF</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($themes as $theme)
              <tr>
                  <td><img style="width: 150px" src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="" title="change the picture"></></td>
                  <td>{{ $theme->name }}</td>
                  <td>{{ $theme->pdf }}</td>
                  <td><a href="{{ url('/') }}/admin/editTheme/{{$theme->id}}" class="btn btn-info" role="button" aria-pressed="true">Edit</a></td>
                  <td>
                    <form action="{{ url('/') }}/admin/deleteTheme/{{$theme->id}}" method="post">
                    @csrf
                      <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </td>
              </tr>
            @endforeach
            <tr>
            </tr>
          </tbody>
        </table>
    </div>
</div>
@endsection
