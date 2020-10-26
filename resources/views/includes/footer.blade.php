 <!-- page specific scripts -->
 <!-- flot charts scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
    integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
    <script src="{{ asset('js/front/front.js') }}"></script>
    <script>

    const swup = new Swup();

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
        const logo = document.getElementById('logo')

        logo.addEventListener('mouseover', function () {
        if (logo.classList.contains('rotation-left')) {
            logo.classList.remove('rotation-left')
        }
        logo.classList.add('rotation-right')
        })

        logo.addEventListener('mouseout', function () {
        if (logo.classList.contains('rotation-right')) {
            logo.classList.remove('rotation-right')
        }
        logo.classList.add('rotation-left')
        })

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

        jQuery( document ).ready(function( $ ){
            $('.navigation').click(function() {
                $('.themes-list').toggle('slow');
            });
        });
    });
 </script>
    </body>
</html>
