@include("layouts.scripts")
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->

    <x-head.tinymce-config/>
 
    <script src="{{ URL::asset('/js/app.js') }}" defer></script>
        
    <title> @yield('title')</title>
    @stack("css")
</head>
<body class="animsition">
    <div class="page-wrapper">
    @include("layouts.header_new")
    <div id="app">
        <example-component/>
    </div>
    <div class="page-content--bgf7">
    @hasSection('breadscrumbs')
        <!-- MAIN CONTENT-->
        <section class="au-breadcrumb2">
                <div class="section__content section__content--p30">
                <div class="container"> 
                        <div class="row">
                            <div class="col-md-12">
                            @yield('breadscrumbs')
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endif
  
        <section class="welcome p-t-10 pb-5">
        <div class="container">       
            @yield('content')
        </div>
        </section>
 
    </div>

     <!-- COPYRIGHT-->
     <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
    </div>
    @stack("js")
</body>
</html>
