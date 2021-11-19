@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Videos</h1>

@include('admin/error')

<div class="row">
    <div class="col-4">
        <h2 class="m-3">Edit the video <strong><a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}">{{$video->title}}</a></strong></h2>
        <img class="m-3" class="edit-video-thumbnail" src="{{ $video->thumbnail_medium }}">
        <br>
        <a href="{{ $video->link }}" class="btn btn-info m-3" role="button" aria-pressed="true">Lien vers la vidéo sur Vimeo</a>
        <hr/>
        <form class="edit-video" action="" enctype="multipart/form-data" method="post">
        @csrf
        <h3 class="m-3">You can change the pdf or the themes</h3>
        <div class="edit-pdf m-3">
            <a class="mb-5" href="{{ url('/') }}/storage/pdf/video/{{$video->pdf}}">{{$video->pdf}}</a>
            <button class="btn btn-info edit-pdf__button">Change pdf</button>
        </div>
        <div class="form-group upload-pdf m-3">
            <label for="pdf">Add a pdf</label>
            <input name="pdf" type="file" class="form-control-file" id="pdf">
        </div>
        <div class="form-group m-3">
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
    </div>
    <div class="col-6">
        <div class="form-group m-3">
         <label for="description">Description</label>
         <textarea name="description" class="form-control editor" id="description" rows="3">{{$video->description}}</textarea>
       </div>
       <button type="submit" class="btn btn-primary m-3">Edit the video</button>
       </form>
   </div>

</div>
@endsection
