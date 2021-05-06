@extends("layouts.front")

@section('title', 'Themes')

@section('content')

<main  id="swup" class="main">
@include('header')
@include('gif')
<div class="singleTheme">
    <div class="background-image transition-fade">
        <img class="background-image__image" src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="{{ $theme->name }}">
        <div class="background-image__blur"></div>
    </div>
        <div class="entry-content transition-fade">
            <div class="header-theme">
                {{-- https://www.xspdf.com/resolution/53718494.html --}}
                @if (!empty($theme->pdf))
                    <div class="button">
                        <a class="yep" href="{{ url('/') }}/storage/pdf/theme/{{$theme->pdf}}" download>pdf</a>
                    </div>
                    <div id="entry-title" class="center entry-title entry-title__page entry-title__page-pdf transition-fade">
                        <h1>{{ $theme->name }}</h1>
                    </div>
                    @else
                    <div id="entry-title" class="center entry-title entry-title__page transition-fade">
                        <h1>{{ $theme->name }}</h1>
                    </div>
                @endif

            </div>
            <div id="entry-content-text" class=entry-content-text>
                {!! $short !!}
            </div>
            <div class="button">
                <span class="yep" data-lity href="#long">Lire + de texte</span>
            </div>
            <div id="long" class="lity-hide">{!! $theme->description !!}</div>
            @if($frame !='none')
                <section class="video-carousel transition-fade">
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
                <section class="video-vignette horizontal-align transition-fade">
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


