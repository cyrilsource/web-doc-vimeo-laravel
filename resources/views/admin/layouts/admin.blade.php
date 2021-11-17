<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Terre Commune - Admin</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tiny.cloud/1/jxlnrmc20xgg41706k5kkku9p1x25ip6oqlo88wjm6oez1iy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </head>
    <body>

<div class="d-flex" id="wrapper">

  <!-- Sidebar -->
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Terre Commune</div>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#videos-collapse" aria-expanded="true">
              Videos
            </button>
            <div class="collapse show" id="videos-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="{{ url('/') }}/admin" class="link-dark rounded">List of videos</a></li>
                <li><a href="{{ url('/') }}/admin/createVideo" class="link-dark rounded">Add a new video</a></li>
              </ul>
            </div>
          </li>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#themes-collapse" aria-expanded="true">
            Themes
          </button>
          <div class="collapse show" id="themes-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="{{ url('/') }}/admin/themes" class="link-dark rounded">List of themes</a></li>
              <li><a href="{{ url('/') }}/admin/createTheme" class="link-dark rounded">Add a new theme</a></li>
            </ul>
          </div>
        </li>

        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
            Orders
          </button>
          <div class="collapse" id="orders-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="#" class="link-dark rounded">New</a></li>
              <li><a href="#" class="link-dark rounded">Processed</a></li>
              <li><a href="#" class="link-dark rounded">Shipped</a></li>
              <li><a href="#" class="link-dark rounded">Returned</a></li>
            </ul>
          </div>
        </li>
        <li class="border-top my-3"></li>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
            Account
          </button>
          <div class="collapse" id="account-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="#" class="link-dark rounded">New...</a></li>
              <li><a href="#" class="link-dark rounded">Profile</a></li>
              <li><a href="#" class="link-dark rounded">Settings</a></li>
              <li><a href="#" class="link-dark rounded">Sign out</a></li>
            </ul>
          </div>
        </li>
      </ul>
  </div>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}/admin">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">to the web site</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
        @yield('content')
    </div>
  </div>
  <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="{{ asset('js/admin/admin.js') }}"></script>

<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  })

  //search videos
  $('body').on('keyup', '#search-videos', function(){
      var query = $(this).val()

      $.ajax({
          method: 'POST',
          url: '{{ route("search-videos" )}}',
          dataType: 'json',
          data: {
              '_token': '{{ csrf_token()}}',
              query: query
          },

          success: function(res) {
            console.log(res)
            var tableRow = '';

            $('#dynamic-row').html('')

            $.each(res, function(index, value){
                var tableRow = '<tr><td>'+value.title+'</td></tr>'

                $('#dynamic-row').append(tableRow)
                console.log(tableRow)
            })
          }
      })
  })

  /* global bootstrap: false */

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl)
  })


  tinymce.init({
      selector: "#description",
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak code fullscreen',
      toolbar: 'styleselect bold italic numlist bullist undo redo blockquote alignleft aligncenter alignright alignjustify code fullscreen',
       // Register the cite format
  formats: {
    cite: {block: 'cite'}
  },

  // Populate the styleselect menu
  style_formats: [
    { title: 'Paragraph', format: 'p'},
    { title: 'Title', format: 'h1'},
    { title: 'Heading', format: 'h2'},
    { title: 'Subheading', format: 'h3'},
    { title: 'Blockquote', format: 'blockquote'},
    { title: 'Cite', format: 'cite' },
    { title: 'Code', format: 'code'}
  ],
  preview_styles: false,
  content_css: false,
  content_style: `
  blockquote {
  position: relative;
  margin: 1.5em 10px;
  padding: 0.5em 10px;
  font-size: 1.2rem;
  font-style: italic;
  line-height: 1.6;
}

    blockquote::before {
    content: "“";
    color: #33375F;
    font-size: 3.5em;
    line-height: 0.1em;
    margin-right: 0.25em;
    vertical-align: -0.4em;
    }

    blockquote::after {
    content: "”";
    color: #33375F;
    font-size: 3.5em;
    line-height: 0.1em;
    margin-left: 0.25em;
    vertical-align: -0.4em;
    }

    blockquote p {
    display: inline-block;
    }

    blockquote cite {
    position: absolute;
    margin-left: 1rem;
    font-size: 1rem;
    font-style: normal;
    left: 50%;
    bottom: -15px;
    -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
            transform: translateX(-50%);
    }

    li {
            list-style-type: none;
        }
    li:before {
        content: "";
        width: 10px;
        height: 10px;
        background: #33375F;
        display: inline-block;
        border-radius: 50%;
        margin-right: 7px;
    }

    a {
        color: #33375F;
        text-decoration: none !important;
        border-bottom: 1px solid #7A6A95;
        box-shadow: inset 0 -0.125em 0 #7A6A95;
        transition: box-shadow 270ms cubic-bezier(0.77, 0, 0.175, 1), color 270ms cubic-bezier(0.77, 0, 0.175, 1);
    }

    a:hover {
        box-shadow: inset 0 -1.125em 0 #7A6A95;
        color: #33375F;
    }
  `
   });

</script>

</body>

</html>
