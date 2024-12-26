<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="/dashboard/css/tabler.min.css?1692870487" rel="stylesheet"/>

    @yield('style')

<body>
{{--<script src="dashboard/js/demo-theme.min.js?1692870487"></script>--}}
<div class="page">

    @include('layout.includes.header')
    <div class="page-wrapper">
        <div class="container mt-3">

        @yield('content')
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src={{ asset('dashboard/js/custom.js') }}></script>

</body>
</html>
