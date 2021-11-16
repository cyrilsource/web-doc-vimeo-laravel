@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">List of videos</h1>
@include('admin/error')

<div class="col-8 margin-top">
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
            <td><img src="{{ $video->thumbnail_small }}"></td>
            <td><a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}">{{ $video->title }}</a></td>
            <td><a href="{{$video->link}}">link on vimeo</a></td>
            <td>
            @foreach ($video->themes as $theme)
                <em>{{$theme->name}}@if (!$loop->last), @endif</em>
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
    <form action="{{ url('/') }}/admin/update-thumbnails" method="post">
        @csrf
        <button type="submit" class="btn btn-info">Update thumbnails</button>
    </form>
</div>

@endsection
