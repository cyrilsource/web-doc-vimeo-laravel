<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Terre Commune - Admin</title>

        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
    <div class="list-group list-group-flush">
      <a href="{{ url('/') }}/admin" class="list-group-item list-group-item-action bg-light">Themes</a>
      <a href="{{ url('/') }}/admin/videos" class="list-group-item list-group-item-action bg-light">Videos</a>
      <a href="{{ url('/') }}/admin/options" class="list-group-item list-group-item-action bg-light">Options</a>

    </div>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="{{ asset('js/admin/admin.js') }}"></script>

<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
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
