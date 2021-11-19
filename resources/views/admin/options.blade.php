@extends("admin/layouts.admin")

@section('content')

<h1 class="mt-4 mb-5 text-center">Options</h1>

<h2 class="mb-3 number-words m-2">Change number of characters for the excerpts</h2>
        <div class="row">
            <div class="col-6">
                <form action="" method="post">
                @csrf
                    <div class="form-group m-2">
                        <label for="title">choose a number</label>
                        <input name="field" type="number" value="{{$words}}" class="form-control" id="field" aria-describedby="title">
                    </div>
                    <button type="submit" class="btn btn-primary m-2">Send</button>
                </form>
            </div>
        </div>
@endsection
