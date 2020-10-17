 <!-- page specific scripts -->
 @yield('pagespecificjquery')
 @yield('pagespecificscripts')
 @yield('pagespecificlityjs')
 <script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
 <script src="{{ asset('js/front/front.js') }}"></script>
 <script>
    const swup = new Swup();
 </script>
        </body>
</html>
