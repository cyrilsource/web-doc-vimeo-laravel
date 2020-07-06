 <!-- page specific scripts -->
 @yield('pagespecificscripts')
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
</script>

        </body>
</html>
