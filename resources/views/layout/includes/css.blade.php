@if (app()->getLocale() == 'en')
    <link href="/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="/css/demo.min.css?1692870487" rel="stylesheet" />

    <!-- datatable v2.1.8 -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/css/custom-datatable.css">
    <!-- End datatable -->
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
@else
    <!-- CSS files -->
    <link href="{{ url('dashboard') }}/css/tabler.rtl.min.css?1692870487" rel="stylesheet" />
    <link href="{{ url('dashboard') }}/css/tabler-flags.rtl.min.css?1692870487" rel="stylesheet" />
    <link href="{{ url('dashboard') }}/css/tabler-payments.rtl.min.css?1692870487" rel="stylesheet" />
    <link href="{{ url('dashboard') }}/css/tabler-vendors.rtl.min.css?1692870487" rel="stylesheet" />
    <link href="{{ url('dashboard') }}/css/demo.rtl.min.css?1692870487" rel="stylesheet" />

    <!-- datatable v2.1.8 -->
    <link rel="stylesheet" href="{{ url('dashboard') }}/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/css/custom-datatable.css">
    <link rel="stylesheet" href="{{ url('dashboard') }}/css/custom-rtl.css">
    <!-- End datatable -->
    <link rel="stylesheet" href="{{ url('dashboard') }}/css/fonts-rtl.css">
@endif

<style>
    .bg-info {
        --tblr-bg-opacity: 1;
        background-color: rgb(245 248 251) !important;
        color: black !important;
    }

    hr {
        margin: 10px;
    }
</style>
