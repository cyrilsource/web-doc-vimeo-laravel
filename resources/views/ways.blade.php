@extends("layouts.front")

@section('title', 'Chemins')

@section('content')
@include('header')
<div class="vimeo-wrapper vimeo-wrapper--half">
   <iframe src="https://player.vimeo.com/video/403735957?background=1&autoplay=1&loop=1&byline=0&title=0"
           frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>


<div class="vimeo-wrapper vimeo-wrapper--half--left">
    <iframe src="https://player.vimeo.com/video/412235203?background=1&autoplay=1&loop=1&byline=0&title=0"
           frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>

<div class="vertical-align">
    <div class="half-screen">
        <h2 class="entry-title">Bateau</h2>
    </div>
    <div class="half-screen">
        <h2 class="entry-title">Terre Ferme</h2>
    </div>
</div>







<h1 class="invisible-title">Choisis ton chemin en Terre Commune</h1>

@endsection
