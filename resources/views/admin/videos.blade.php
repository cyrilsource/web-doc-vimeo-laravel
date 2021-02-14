@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Videos</h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#list" role="tab" aria-controls="home" aria-selected="true">List of videos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#video" role="tab" aria-controls="profile" aria-selected="false">Propose a new video</a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="home-tab">
        <div class="col-8 margin-top">
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
                    <td><img src="{{ $video->thumbnail_medium }}"></td>
                    <td>{{ $video->title }}</td>
                    <td><a href="{{$video->link}}">link</a></td>
                    <td>
                        @foreach ($video->themes as $theme)
                            <em>{{$theme->name}},</em>
                        @endforeach
                    </td>
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

    <div class="tab-pane fade show" id="video" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-4 m-5">
                <h2>Propose a new video</h2>
                <form action="{{ url('/') }}/admin/videos" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="form-group">
                        <label for="link">video link</label>
                        <input name="link" type="text" class="url form-control @error('link') is-invalid @enderror"
                        id="link" aria-describedby="link"
                        value="{{ old('link') }}" required pattern="^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$">
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
            </div>
            <div class="col-6 margin-top">
                <div class="form-group">
                   <label for="description">Description</label>
                   <textarea name="description" class="form-control @error('name') is-invalid @enderror"
                   id="description" rows="10">
                   {{ old('description') }}
                   </textarea>
                   @error('description')
                   <div class="alert alert-danger" role="alert">
                       {{ $errors->first('description') }}
                   </div>
                   @enderror
               </div>
               <button type="submit" class="btn btn-primary">Add a video</button>
            </div>
                </form>
        </div>


    </div>
</div>



@endsection
