@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Propose a new video</h1>
@include('admin/error')

        <div class="row">
            <div class="col-4 m-5">
                <form action="{{ url('/') }}/admin" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="form-group m-4">
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
                    <div class="form-group m-4">
                        <label for="themes[]">Themes</label>
                        <select class="form-control-select" name="themes[]" multiple="multiple">
                            @foreach ($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach
                        </select>
                        @error('themes')
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('themes') }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group m-4">
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
                    <div class="form-group m-4">
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
                <button type="submit" class="btn btn-primary m-4">Add a video</button>
                </div>
            </form>
        </div>
    </div>

@endsection
