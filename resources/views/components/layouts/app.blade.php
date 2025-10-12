<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

    {{-- Bootstrap 4.6 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOoLHFlEh07pJGoPkVL1bcEPTNaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4Hi+N"
        crossorigin="anonymous">
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="mt-2">

    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGNR9IGLqF7aIDq0Qb7X02vcrdIwxjfTh9H8CSR7PBEaKr51Ck+w+/U6swU2Im1vVXOSvK9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- AdminLTE 3.2 --}}
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    {{-- Custom CSS dari Laravel Mix --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('components.partials.sidebar')

        <div class="content-wrapper">
            @include('components.partials.header')
            {{ $slot }}
        </div>

        @include('components.partials.footer')
    </div>

    {{-- jQuery wajib duluan --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+sZ+0J7yB/wwguDgSQH5M9j1yP6bV8Dd2AA5u6U="
    crossorigin="anonymous"></script>

{{-- Bootstrap bundle (sudah termasuk Popper.js) --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2LcAqPzjK1L1qzYpD95KqE6k9zRHEE15m5u5G3fvb6"
    crossorigin="anonymous"></script>

{{-- AdminLTE --}}
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

{{-- Laravel app.js (axios, dll.) --}}
<script src="{{ mix('js/app.js') }}"></script>


    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGNR9IGLqF7aIDq0Qb7X02vcrdIwxjfTh9H8CSR7PBEaKr51Ck+w+/U6swU2Im1vVXOSvK9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOoLHFlEh07pJGoPkVL1bcEPTNaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4Hi+N" crossorigin="anonymous">
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('components.partials.sidebar')

        <div class="content-wrapper">
            @include('components.partials.header')
            {{ $slot }}
        </div>

        @include('components.partials.footer')
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD51S9hGZ0ReFYm4dnMc1QhSNtvYSaNcQU+U1T9qvYdnhz0PPSiqn/+3e7JoAEaG7TubfwGurMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    @stack('scripts')
</body>

</html>