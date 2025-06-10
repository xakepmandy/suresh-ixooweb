<!DOCTYPE html>
<html lang="en-US" class="no-js">
@include('front.layouts.head')
<body class="home page-template page-template-tmpl page-template-template-fullwidth page-template-tmpltemplate-fullwidth-php page page-id-9 wp-custom-logo wp-embed-responsive sliding-desktop-off sliding-slide layout-wide elementor-default elementor-kit-11 elementor-page elementor-page-9" itemscope="itemscope" itemtype="https://schema.org/WebPage">
@include('front.layouts.header')
<div id="site-content" class="site-content">		
    <div id="content-body" class="content-body">
        <div class="content-body-inner wrap">
            @yield('content')
        </div>
    </div>
</div>
 @include('front.layouts.footer')
</body>
</html>
		