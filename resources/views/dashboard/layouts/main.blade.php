<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Primera Justicia | Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

    </style>
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>

    @yield('head')
</head>

<body>

    @include('dashboard.layouts.header')

    <div class="container-fluid">
        <div class="row">
            @include('dashboard.layouts.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <div id="preloader"></div>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/gsap.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
    {{-- <script src="{{ asset('js/EaselPlugin.min.js') }}"></script> --}}
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script> --}}

    {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
    <script>
        feather.replace()
    </script>


    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            didClose: () => {
                window.location.href = '/dashboard/posts';
            }
        })

        const Toast_Post = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        const pesan = {
            berhasil: (text) => {
                swalWithBootstrapButtons.fire({
                    title: 'Berhasil!',
                    text: text,
                    imageUrl: "{{ asset('sticker/wink.png') }}",
                    imageWidth: 200,
                    imageHeight: 200,
                    imageAlt: 'Custom image'
                })
            }
        }
    </script>

    @if (session('success'))
        <script>
            {!! session('success') !!}
        </script>
    @endif

    {{-- Untuk javascript --}}
    @yield('script')
</body>

</html>
