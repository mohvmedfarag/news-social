<!DOCTYPE html>
<html lang="en">

@include('layouts.frontend.head')

<body>

    @include('layouts.frontend.header')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                @section('breadcrumbs')
                    <!-- empty -->
                @show
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    @yield('content')

    @include('layouts.frontend.footer')
    <!-- js libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="{{asset('assets/front-end/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/front-end/lib/slick/slick.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- template js -->
    <script src="{{ asset('assets/front-end/js/main.js') }}"></script>
    <!-- file input plugin -->
    <script src="{{ asset('assets/front-end/vendor/file-input/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/front-end/vendor/file-input/themes/fa5/theme.min.js') }}"></script>

    <!-- summernote plugin -->
    <script src="{{asset('assets/front-end/vendor/summernote/summernote-bs4.min.js')}}"></script>
    @stack('js')
</body>

</html>
