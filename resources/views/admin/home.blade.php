@extends("admin/layouts.admin")

@section('content')


<h1 class="mt-4 mb-5 text-center">Themes</h1>
@include('admin/error')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="themes-tab" data-toggle="tab" href="#themes" role="tab" aria-controls="profile" aria-selected="false">Propose a new theme</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="home" aria-selected="true">List of themes</a>
    </li>

</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="themes" role="tabpanel" aria-labelledby="themes-tab">
        <div class="row">
          <div class="col-4 margin-top">
            <h2>Create a theme</h2>
              <form action="{{ url('/') }}/admin" enctype="multipart/form-data" method="post">
              @csrf

                <div class="form-group">
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
                <div class="form-group">
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
                <button type="submit" class="btn btn-primary">Create a theme</button>
              </div>
            </form>
            </div>

    </div>
    <div class="tab-pane fade show" id="list" role="tabpanel" aria-labelledby="home-tab">
        <div class="col-8 margin-top">
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
                      <td><img style="width: 150px" src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="" title="change the picture"></td>
                      <td><a href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">{{ $theme->name }}</a></td>
                      <td><a href="{{ url('/') }}/storage/pdf/theme/{{$theme->pdf}}">{{$theme->pdf}}</a></td>
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

</div>


@endsection
