@extends("layouts.front")

@section('title', 'Themes')

@section('content')

<main  id="swup" class="main">
@include('header')
@include('gif')
<div class="singleTheme">
    <div class="background-image transition-fade2">
        <img class="background-image__image" src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="{{ $theme->name }}">
        <div class="background-image__blur"></div>
    </div>
        <div class="entry-content transition-fade2">
            <div class="header-theme">
                {{-- https://www.xspdf.com/resolution/53718494.html --}}
                @if (!empty($theme->pdf))
                    <div class="button">
                        <span id="pdf" class="yep" data-link="{{ url('/') }}/storage/pdf/theme/{{$theme->pdf}}">pdf</span>
                    </div>
                    <div id="entry-title" class="center entry-title entry-title__page entry-title__page-pdf transition-fade2">
                        <h1>{{ $theme->name }}</h1>
                    </div>
                    @else
                    <div id="entry-title" class="center entry-title entry-title__page transition-fade2">
                        <h1>{{ $theme->name }}</h1>
                    </div>
                @endif

            </div>
            <div id="entry-content-text" class=entry-content-text>
                {{ $theme->excerpt }}
            </div>
            <div class="button">
                <span class="yep" data-lity href="#long">Lire + de texte</span>
            </div>
            <div id="long" class="lity-hide">{!! $theme->description !!}</div>
            @if($frame !='none')
                <section class="video-carousel transition-fade2">
                    @foreach ($videos as $video)
                        <a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="video-carousel-card">
                            <div class="video-carousel-card__title">
                                <h3>{{ $video->title }}</h3>
                                <p>{{ $video->duration }}</p>
                            </div>
                            <img src="{{ $video->thumbnail_large }}">
                        </a>
                    @endforeach
                </section>
            @else
                <section class="video-vignette horizontal-align transition-fade2">
                    @foreach ($videos as $video)
                        <a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="video-vignette-card">
                            <div class="video-vignette-card__title">
                                <h3>{{ $video->title }}</h3>
                                <p>{{ $video->duration }}</p>
                            </div>
                            <img src="{{ $video->thumbnail_large }}">
                        </a>
                    @endforeach
                </section>
            @endif
        </div>
    </div>

</main>

@endsection


