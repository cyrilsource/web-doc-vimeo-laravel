 <!-- page specific scripts -->
 <!-- flot charts scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js"
    integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA=="
    crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
    <script src="{{ asset('js/front/front.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Import typeahead.js -->
  	<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script>
    //https://kerneldev.com/laravel-autocomplete-search-with-typeahead-js/
    $(document).ready(function() {
            var baseUrl = '/terrecommune/public/'
      		var bloodhound = new Bloodhound({
  				datumTokenizer: Bloodhound.tokenizers.whitespace,
  				queryTokenizer: Bloodhound.tokenizers.whitespace,
  				remote: {
  					url: baseUrl + 'autocomplete?q=%QUERY%',
  					wildcard: '%QUERY%'
  				},
  			});


  			$('.search-autocomplete').typeahead({
  				hint: true,
  				highlight: true,
  				minLength: 1
  			}, {
  				name: 'videos',
  				source: bloodhound,
  				display: function(data) {
  					return data.title  //Input value to be set when you select a suggestion.
  				},
  				templates: {
  					empty: [
  						'<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
  					],
  					suggestion: function(data) {
  					return '<a href="'+ baseUrl + 'video/' + data.slug + '/ '+ data.id + '" class="list-group-item">' + data.title + '</a>'
  					},

  				}
  			});
          });

    const swup = new Swup();

    jQuery( document ).ready(function( $ ){
        $('.video-carousel').slick({
            centerMode: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<button class="slide-arrow prev-arrow"></button>',
            nextArrow: '<button class="slide-arrow next-arrow"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        centerMode: true,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    });

    var hamburger = document.querySelector('.m-nav-toggle')
        var op = document.querySelector('.menu')
        var cross = document.querySelector('.close')
        var menuItem = document.querySelectorAll('.menu-item')
        hamburger.addEventListener('click', function () {
            op.classList.toggle('is-open')
            cross.classList.toggle('is-open')
        })
        cross.addEventListener('click', function () {
            op.classList.remove('is-open')
            cross.classList.remove('is-open')
        })
        for (var index = 0; index < menuItem.length; index++) {
            menuItem[index].addEventListener('click', function () {
            op.classList.remove('is-open')
            cross.classList.remove('is-open')
            })
        }

    document.addEventListener('swup:contentReplaced', function () {
        const logo = document.getElementById('logo')

        if (logo) {
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
        }

        var hamburger = document.querySelector('.m-nav-toggle')
        var op = document.querySelector('.menu')
        var cross = document.querySelector('.close')
        var menuItem = document.querySelectorAll('.menu-item')
        hamburger.addEventListener('click', function () {
            op.classList.toggle('is-open')
            cross.classList.toggle('is-open')
        })
        cross.addEventListener('click', function () {
            op.classList.remove('is-open')
            cross.classList.remove('is-open')
        })
        for (var index = 0; index < menuItem.length; index++) {
            menuItem[index].addEventListener('click', function () {
            op.classList.remove('is-open')
            cross.classList.remove('is-open')
            })
        }

        jQuery( document ).ready(function( $ ){
			$('.video-carousel').slick({
            centerMode: true,
			infinite: true,
			slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<button class="slide-arrow prev-arrow"></button>',
            nextArrow: '<button class="slide-arrow next-arrow"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        centerMode: true,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
		    });

        });

        let navigation = document.querySelector('.navigation')
        let themesList = document.querySelector('.themes-list')
        navigation.addEventListener('mouseover', function (e) {
            themesList.classList.add('open-list')
        })
        navigation.addEventListener('mouseout', function (e) {
            themesList.classList.remove('open-list')
        })

        let darkMode = document.getElementById('btn-dark-mode')

        if (darkMode) {
            let body = document.getElementById('body')
            darkMode.addEventListener('click', function () {
                body.classList.toggle('dark-theme')
                if (body.classList.contains('dark-theme')) {
                setCookie('theme', 'dark')
                } else {
                setCookie('theme', 'light')
                }
            })
        }

        let darkModeMobile = document.getElementById('btn-dark-mode-mobile')

        if (darkModeMobile) {
            let body = document.getElementById('body')
            darkModeMobile.addEventListener('click', function () {
                body.classList.toggle('dark-theme')
                if (body.classList.contains('dark-theme')) {
                setCookie('theme', 'dark')
                } else {
                setCookie('theme', 'light')
                }
            })
        }
        // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website
        function setCookie (name, value) {
            var d = new Date()
            d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000))
            var expires = 'expires=' + d.toUTCString()
            document.cookie = name + '=' + value + ';' + expires + ';path=/'
        }

        let back = document.getElementById('logo-back')
        if (back) {
            back.addEventListener('click', function (e) {
                e.preventDefault()
                window.history.back()
            })
        }

        let back2 = document.getElementById('logo-back2')
            if (back2) {
            back2.addEventListener('click', function (e) {
                e.preventDefault()
                window.history.back()
            })
        }

        let title = document.querySelector('.entry-title__page h1')

        if (title) {
        let text = title.textContent
        var words = text.split(' ')
        for (var i = 0; i < words.length; i++) {
            if (words[i].length > 9) {
                title.classList.add('long-text')
                }
            }
        }

        // get search form on mobile
        let glass = document.getElementById('glass-mobile')

        if (glass) {
            let searchContainer = document.getElementById('search-container-mobile')
            let object = document.getElementsByClassName('header-mobile-object')
            glass.addEventListener('click', function () {
                searchContainer.classList.toggle('reveal')
                glass.classList.toggle('reveal')
                for (let index = 0; index < object.length; index++) {
                object[index].classList.toggle('unreveal')
                }
            })
        }

        // open pdf in new tab
        let pdf = document.getElementById('pdf')

        if (pdf) {
            let href = pdf.dataset.link
            pdf.addEventListener('click', function (e) {
                window.open(href)
            })
        }

    });
 </script>
    </body>
</html>
