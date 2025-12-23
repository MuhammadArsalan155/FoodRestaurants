<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('admin.layouts.partials/head-css')
</head>

<body>

<div class="wrapper">

    @include("admin.layouts.partials/topbar", ['title' => $title])
    @include('admin.layouts.partials/main-nav')

    <div class="page-content">

        <div class="container-fluid">
            @yield('content')
        </div>

        @include("admin.layouts.partials/footer")

    </div>

</div>

@include("admin.layouts.partials/right-sidebar")
@include("admin.layouts.partials/footer-scripts")
@vite(['resources/js/app.js','resources/js/layout.js'])

</body>

</html>
