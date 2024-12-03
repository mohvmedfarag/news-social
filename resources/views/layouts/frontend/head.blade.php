<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta
      content="Bootstrap News Template - Free HTML Templates"
      name="keywords"
    />
    <meta
      content="@yield('meta_desc')"
      name="description"
    />

    <meta name="robots" content="index, follow"/>

    @stack('canonical')

    <!-- Favicon -->
    
    <link href="{{asset('favicon.ico')}}" rel="icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap"
      rel="stylesheet"
    />

    <!-- CSS Libraries -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{asset('assets/front-end/lib/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front-end/lib/slick/slick-theme.css')}}">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/front-end/css/style.css')}}">

    <!-- file input plugin -->
    <link rel="stylesheet" href="{{asset('assets/front-end/vendor/file-input/css/fileinput.min.css')}}">

    <!-- summernote plugin -->
    <link rel="stylesheet" href="{{asset('assets/front-end/vendor/summernote/summernote-bs4.min.css')}}">
  </head>