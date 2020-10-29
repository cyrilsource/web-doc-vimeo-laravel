@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Videos</h1>

@include('admin/error')

<div class="row">
    <div class="col-4">
    <h2>Edit the video {{$video->name}}</h2>
      <form action="" enctype="multipart/form-data" method="post">
      @csrf
        <div class="form-group">
            <label for="link">video link</label>
            <input name="link" type="text" class="url form-control @error('link') is-invalid @enderror"
            id="link" aria-describedby="link"
            value="{{ $video->link }}" required pattern="^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$">
            @error('link')
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('link') }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Edit the video</button>
      </form>
    </div>

</div>
@endsection
