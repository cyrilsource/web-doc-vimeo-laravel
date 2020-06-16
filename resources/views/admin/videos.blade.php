@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Videos</h1>

<div class="row">
    <div class="col-4">
    <h2>Propose a new video</h2>
      <form action="{{ url('/') }}/admin/videos" enctype="multipart/form-data" method="post">
      @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
            id="name" aria-describedby="name"
            value="{{ old('name') }}">
            @error('name')
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="link">video link</label>
            <input name="link" type="text" class="form-control @error('link') is-invalid @enderror"
            id="link" aria-describedby="link"
            value="{{ old('link') }}">
            @error('link')
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('link') }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="themes[]">Themes</label>
            <select class="form-control-select" name="themes[]" multiple="multiple">
                @foreach ($themes as $theme)
                    <option value="{{$theme->id}}">{{$theme->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pdf">Add a pdf</label>
            <input name="pdf" type="file" class="form-control-file" id="pdf">
            @error('pdf')
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('pdf') }}
            </div>
            @enderror
        </div>
         <div class="form-group">
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
        <button type="submit" class="btn btn-primary">Add video</button>
      </form>
    </div>
    <div class="col-5 offset-md-1">
        <h2>List of videos</h2>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Thumbnail</th>
              <th scope="col">Name</th>
              <th scope="col">Video</th>
              <th scope="col">Themes</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($videos as $video)
              <tr>
                  <td></td>
                  <td>{{ $video->name }}</td>
                  <td><a href="{{$video->link}}">link</a></td>
                  <td></td>
                  <td><a href="{{ url('/') }}/admin/editVideo/{{$video->id}}" class="btn btn-info" role="button" aria-pressed="true">Edit</a></td>
                  <td>
                    <form action="{{ url('/') }}/admin/deleteVideo/{{$video->id}}" method="post">
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
