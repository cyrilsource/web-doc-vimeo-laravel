@extends("layouts.front")


@section('title', 'Themes')

@section('content')
<main  id="swup" class="main">
@include('header')
    <div class="">
        <div class="transition-fade2">
            @foreach ($themes as $theme)
                <a  href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">
                    <h2 class="">{{ $theme->name }}</h2>
                </a>
                <div id="entry-content-text" class=entry-content-text>
                    {{ $theme->excerpt }}
                </div>
                <section class="video-carousel transition-fade margin-bottom">
                @foreach ($theme->videos as $video)
                    <a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="video-carousel-card">
                        <div class="video-carousel-card__title">
                            <h3>{{ $video->title }}</h3>
                            <p>{{ $video->duration }}</p>
                        </div>
                        <img src="{{ $video->thumbnail_large }}">
                    </a>
                @endforeach
                </section>
            @endforeach
        </div>

    </div><!-- .entry-content-themes-->
</main>



@endsection
