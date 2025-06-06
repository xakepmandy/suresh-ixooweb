<!doctype html>
<html lang="en" class="light-theme">
@include('admin.layouts.head')
<body>
     <!--start wrapper-->
  <div class="wrapper">
    @include('admin.layouts.header')
    {{-- @include('admin.layouts.sidebar') --}}
    <main class="page-content">
        {{-- @include('admin.layouts.breadcrumbs') --}}
         @include('admin.layouts.alerts')
         @yield('content')
   </main>
  </div>
<!--end wrapper-->
@include('admin.layouts.footer')

</body>

</html>