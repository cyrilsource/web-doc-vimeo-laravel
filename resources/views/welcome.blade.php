@extends("layouts.front")


@section('title', 'Accueil')

@section('content')
@include('header')
<div class="vimeo-wrapper">
   <iframe src="https://player.vimeo.com/video/412231490?background=1&autoplay=1&loop=1&byline=0&title=0"
           frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<div class="vertical-align">
    <div class="main-title">
        <h1 class="entry-title">terre commune</h1>
        <div class="horizontal-align">
            <a href="ways" class="custom-btn custom-btn--outline">Commencez</a>
        </div>
    </div>
</div>

@endsection
