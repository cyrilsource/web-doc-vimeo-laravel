@extends("admin/layouts.admin")

@section('content')


<h1 class="mt-4 mb-5 text-center">List of themes</h1>
<a href="{{ url('/') }}/admin/createTheme" class="btn btn-primary">Add a new theme</a>
@include('admin/error')

<div class="col-8 margin-top">
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

@endsection
