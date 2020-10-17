@extends("layouts.front")


@section('title', 'Themes')
@if($frame !='none')
    @section('pagespecificslick')
        <!-- flot charts css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" />
    @stop
@endif
@section('pagespecificlity')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css"
    integrity="sha512-UiVP2uTd2EwFRqPM4IzVXuSFAzw+Vo84jxICHVbOA1VZFUyr4a6giD9O3uvGPFIuB2p3iTnfDVLnkdY7D/SJJQ=="
    crossorigin="anonymous" />
@stop

@section('content')

@include('header')

<main  id="swup" class="main">
@include('gif')
<div class="background-image transition-fade">
    <img class="background-image__image" src="{{ url('/') }}/storage/img/theme/{{$theme->thumbnail}}" alt="{{ $theme->name }}">
    <div class="background-image__blur"></div>
</div>
    <div class="center entry-title entry-title__page transition-fade">
        <h1>{{ $theme->name }}</h1>
    </div>
    <div class="entry-content transition-fade">
        {{ $theme->description}}
    </div>
    @if($frame !='none')
        <section class="video-carousel transition-fade">
            @foreach ($videos as $video)
                <a href="{{ $video->link }}" data-lity class="video-carousel-card">
                    <h3 class="video-carousel-card__title">{{ $video->title }}</h3>
                    <img src="{{ $video->thumbnail_large }}">
                </a>
            @endforeach
        </section>
    @else
        <section class="video-vignette horizontal-align transition-fade">
            @foreach ($videos as $video)
                <a href="{{ $video->link }}" data-lity class="video-vignette-card">
                    <h3 class="video-vignette-card__title">{{ $video->title }}</h3>
                    <img src="{{ $video->thumbnail_large }}">
                </a>
            @endforeach
        </section>
    @endif

</main>

@endsection
@section('pagespecificjquery')
    <!-- flot charts scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
@stop
@section('pagespecificlityjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
crossorigin="anonymous"></script>
@stop
@if($frame !='none')
    @section('pagespecificscripts')
        <!-- flot charts scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous"></script>
        <script>
        jQuery( document ).ready(function( $ ){
            $('.video-carousel').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        });

        document.addEventListener('swup:contentReplaced', function () {
		jQuery( document ).ready(function( $ ){
			$('.video-carousel').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});

	});



});
    </script>
    @stop
@endif
