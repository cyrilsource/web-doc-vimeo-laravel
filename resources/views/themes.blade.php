@extends("layouts.front")


@section('title', 'Themes')

@section('content')
<main  id="swup" class="main">
@include('header')
    <div class="entry-content-themes">
        <div class="entry-content-themes__grid transition-fade2">
            @foreach ($themes as $theme)
                <a  href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}" class="entry-content-themes__card">
                    <img src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="{{ $theme->name }}">
                    <h2 class="entry-content-themes__title">{{ $theme->name }}</h2>
                </a>
            @endforeach
        </div>

    </div><!-- .entry-content-themes-->
</main>



@endsection
