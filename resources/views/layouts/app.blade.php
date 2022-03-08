@include("layouts.scripts")
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->

    <x-head.tinymce-config/>
    <title> @yield('title')</title>
    @stack("css")
</head>
<body class="animsition">
 
<div class="page-wrapper">
        @include("layouts.header")
            <!-- HEADER DESKTOP-->
            @hasSection('breadscrumbs')
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
        @endif
            <div class="main-content  @hasSection('breadscrumbs') pt-4 @else m-t-25  @endif">


            @yield('content')
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>
    @stack("js")
</body>
</html>
