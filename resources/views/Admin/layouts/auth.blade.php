<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    @include('admin.layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('admin.layouts.partials/head-css')
</head>

<body class="h-100">

@yield('content')

@include("admin.layouts.partials/footer-scripts")
@vite(['resources/js/app.js','resources/js/layout.js'])

</body>

</html>
