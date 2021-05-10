@extends("layouts.front")


@section('title', 'Themes')

@section('content')
<main  id="swup" class="main">
@include('header')
    <div class="theme-list">
        <div class="transition-fade2">
            @foreach ($themes as $theme)
                <a  class="theme-list__theme-link" href="{{ url('/themes') }}/{{ $theme->slug }}/{{ $theme->id }}">
                    <h2 class="theme-list__title">{{ $theme->name }} &rarr;</h2>
                </a>
                <div id="entry-content-text" class="entry-content-text ">
                    {{ $theme->excerpt }}
                </div>
                @if (count($theme->videos) > 2)

                    <section class="video-carousel transition-fade2 margin-bottom">
                    @foreach ($theme->videos as $video)

                        <a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="video-carousel-card">
                            <div class="video-carousel-card__title">
                                <h3>{{ $video->title }}</h3>
                                @if ($video->duration < 60)
                                <p>{{ $video->duration }} sec</p>
                                @else
                                    @if ($video->duration%60 > 0)
                                        <p>@php echo floor($video->duration/60) .' '. 'min ' . $video->duration%60 . ' ' .'sec'; @endphp</p>
                                        @else
                                        <p>@php echo floor($video->duration/60) .' '. 'min '; @endphp</p>
                                    @endif
                                @endif
                            </div>
                            <img src="{{ $video->thumbnail_large }}">
                            <div class="video-play-button-soft"><span></span></div>
                        </a>
                    @endforeach
                    </section>
                    @else
                    <section class="video-vignette horizontal-align transition-fade2 margin-bottom">
                        @foreach ($theme->videos as $video)
                            <a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="video-vignette-card">
                                <div class="video-vignette-card__title">
                                    <h3>{{ $video->title }}</h3>
                                    @if ($video->duration < 60)
                                    <p>{{ $video->duration }} sec</p>
                                    @else
                                        @if ($video->duration%60 > 0)
                                            <p>@php echo floor($video->duration/60) .' '. 'min ' . $video->duration%60 . ' ' .'sec'; @endphp</p>
                                            @else
                                            <p>@php echo floor($video->duration/60) .' '. 'min '; @endphp</p>
                                        @endif
                                    @endif
                                </div>
                                <img src="{{ $video->thumbnail_large }}">
                                <div class="video-play-button-soft"><span></span></div>
                            </a>
                        @endforeach
                    </section>
                @endif
            @endforeach
        </div>

    </div>
</main>



@endsection
