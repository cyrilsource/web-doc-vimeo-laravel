@extends("admin/layouts.admin")

@section('content')


<h1 class="mt-4 mb-5 text-center">List of videos</h1>
<div id="app">
    <app></app>
</div>

<form action="{{ url('/') }}/admin/update-thumbnails" method="post">
    @csrf
    <button type="submit" class="btn btn-info">Update thumbnails</button>
</form>


@endsection
