@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Videos</h1>

@include('admin/error')

<div class="row">
    <div class="col-4">
        <h2>Edit the video <strong>{{$video->title}}</strong></h2>
        <img class="edit-video-thumbnail" src="{{ $video->thumbnail_medium }}">
        <br>
        <a href="{{ $video->link }}" class="btn btn-info" role="button" aria-pressed="true">Lien vers la vidéo</a>
        <hr/>
        <form class="edit-video" action="" enctype="multipart/form-data" method="post">
        @csrf
        <h3>You can change the pdf or the themes</h3>
            <div class="edit-pdf">
                <a class="mb-5" href="{{ url('/') }}/storage/pdf/video/{{$video->pdf}}">{{$video->pdf}}</a>
                <button class="btn btn-info edit-pdf__button">Change pdf</button>
            </div>
            <div class="form-group upload-pdf">
                <label for="pdf">Add a pdf</label>
                <input name="pdf" type="file" class="form-control-file" id="pdf">
            </div>
            <div class="form-group">
                <label for="themes[]"><h4>Themes</h4></label><br>
                <select class="form-control-select" name="themes[]" multiple="multiple">
                {{-- Comment stackoverflow laravel-edit-form-select-default-selection --}}
                    @foreach ($themes as $theme)
                    <option value="{{$theme->id}}" @foreach ($themes_video as $theme_video)
                    @if($theme_video->name=== $theme->name) selected='selected' @endif @endforeach>
                    {{$theme->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Edit the video</button>
        </form>
    </div>

</div>
@endsection
