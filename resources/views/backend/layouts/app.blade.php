<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/backend/dashmin/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/dashmin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/backend/dashmin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    <!-- Template Stylesheet -->
    <link href="{{ asset('public/backend/dashmin/css/style.css') }}" rel="stylesheet">
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.js"></script> --}}

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('backend.layouts.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            @include('backend.layouts.navbar')
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade in show col-md-12">
                    <strong>Error!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade in show col-md-12">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
            @include('backend.layouts.footer')


        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/backend/dashmin/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('public/backend/dashmin/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('public/backend/dashmin/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/backend/dashmin/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/backend/dashmin/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/backend/dashmin/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('public/backend/dashmin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>



    <!-- Template Javascript -->
    <script src="{{ asset('public/backend/dashmin/js/main.js') }}"></script>
    <script>
        function dragdrop(value, name, fillbox) {
            // console.log(document.getElementById(name));
            console.log(document.getElementById(name).checked);
            if (document.getElementById(name).checked) {
                var userselect = document.getElementsByName(fillbox)[0];
                var option = document.createElement('option');
                option.value = value;
                option.id = name;
                option.innerText = name;
                option.selected = true;
                userselect.appendChild(option);
            } else {
                var userselect = document.getElementsByName(fillbox)[0];
                for (let index = 0; index < userselect.length; index++) {
                    if (userselect[index].id == name) {
                       userselect.removeChild(userselect[index]);
                        
                    }
                    
                }
            }
        }
    </script>
    @yield('script')
</body>

</html>
