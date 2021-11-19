@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">List of videos</h1>
<a href="{{ url('/') }}/admin/createVideo" class="btn btn-primary m-3">Add a new video</a>
<div id="app" class="m-3">
    <app></app>
</div>

<form action="{{ url('/') }}/admin/update-thumbnails" method="post">
    @csrf
    <button type="submit" class="btn btn-info">Update thumbnails</button>
</form>

@endsection
