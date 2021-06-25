@extends("layouts.front")
<!--https://stackoverflow.com/questions/34676729/add-meta-tags-to-laravel-page-->
@section('title')
{{$theme->name}}
@stop

@section('description')
{{ $metadescription }}
@stop

@section('url')
themes/{{$theme->slug}}/{{$theme->id}}
@stop

@section('image')
{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}
@stop

@section('content')

<main  id="swup" class="main" role="main">
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
                    <a id="pdf" class="button" href="#" data-link="{{ url('/') }}/storage/pdf/theme/{{$theme->pdf}}">
                        <span class="yep" >pdf</span>
                    </a>
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
            <a href="#long" class="button" data-lity href="#long">
                <span class="yep" >Lire + de texte</span>
            </a>
            <div id="long" class="lity-hide">{!! $theme->description !!}</div>
            @if($frame !='none')
                <section class="video-carousel transition-fade2">
                    @foreach ($videos as $video)
                        <a href="{{ url('/video') }}/{{ $video->slug }}/{{ $video->id }}" class="video-carousel-card">
                            <div class="video-carousel-card__title">
                                <h3>{{ $video->title }}</h3>
                                <p>{{ $video->duration }}</p>
                            </div>
                            <img src="{{ $video->thumbnail_large }}" alt="{{ $video->title }}">
                            <div class="video-play-button-soft"><span></span></div>
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
                            <img src="{{ $video->thumbnail_large }}" alt="{{ $video->title }}">
                            <div class="video-play-button-soft"><span></span></div>
                        </a>
                    @endforeach
                </section>
            @endif
        </div>
    </div>

</main>

@endsection


