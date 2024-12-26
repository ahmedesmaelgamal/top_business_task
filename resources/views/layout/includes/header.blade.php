<!-- header area -->
<section class="header header-2">
    <div class="menu_area menu1 menu-sticky">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-0">
                <a class="navbar-brand order-sm-1 order-1" href=""><img src="{{ asset('demo/img/logo.png') }}"
                                                                        alt="" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="la la-bars"></span>
                </button>
                <div class="collapse navbar-collapse order-md-1" id="navbarSupportedContent2">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item {{ Request::route()->getName() == 'employee.index' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('employee.index') }}">Home</a>
                        </li>
                        <li class="nav-item {{ Request::route()->getName() == 'employee.info' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('employee.index') }}">Home</a>
                        </li>
{{--                        <li--}}
{{--                            class="nav-item {{ Request::route()->getName() == 'employee.index' || Request::route()->getName() == '' ? 'active' : '' }}">--}}
{{--                            <a class="nav-link" href="{{ route('employee.index') }}" aria-haspopup="true"--}}
{{--                               aria-expanded="false">Products</a>--}}
{{--                        </li>--}}

                    </ul>
                    <!-- end: .navbar-nav -->
                </div>

            </nav>
        </div>
    </div>
    <!-- end menu area -->
</section>
<!-- end: .header -->
