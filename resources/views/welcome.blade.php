@extends("layouts.front")


@section('title', 'Accueil')

@section('content')
    <main id="swup" class="front transition-slide">
    @include('gif')
        <div class="vimeo-wrapper">
            <iframe class="vimeo-wrapper transition-fade2" src="https://player.vimeo.com/video/412231490?background=1&autoplay=1&loop=1&byline=0&title=0"
                frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
        <div class="vertical-align">
            <div class="main-title">
                <h1 class="entry-title transition-fade">terre commune</h1>
                <div class="horizontal-align">
                    <a href="{{ url('/themes') }}" class="custom-btn custom-btn--outline transition-fade">Commencez</a>
                </div>
            </div>
        </div>
    </main>
@endsection

