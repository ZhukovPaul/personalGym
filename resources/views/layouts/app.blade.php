@include("layouts.scripts")
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title> @yield('title')</title>
    @stack("css")
</head>
<body class="animsition">
<div class="page-wrapper">
        @include("layouts.header")
            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                            @yield('breadscrumbs')
         
                            </div>
                        </div>
                    </div>
                </div>
        </section>
            <div class="main-content pt-4">


            @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>
    @stack("js")
</body>
</html>
