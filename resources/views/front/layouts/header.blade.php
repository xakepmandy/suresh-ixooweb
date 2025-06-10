	<?php
    use App\Models\Category;
    use App\Models\Subcategory;
    use App\Models\Page;

    $categories = Category::with(['subcategories.pages'])->where('status', 1)->get();

    ?>		
<div id="site" class="site wrap">
	<div id="site-topbar" class="site-topbar">
		<div class="site-topbar-inner wrap">
				<div class="topbar-text">
					<div class="contact-container">
                    <div class="contact-bar">
                        <div class="contact-text">Redefining outsourcing - where excellence and trust unite</div>
                        <div class="contact-links">
                            <a href="tel:+912269710996" class="contact-btn">📞 +91 226 971 0996</a>
                            <a href="mailto:Info@ixooweb.com" class="contact-btn">✉️ Info@ixooweb.com</a>
                        </div>
                    </div>
                </div>

<style>
.contact-container {
    width: 100%;
    overflow: hidden;
    box-sizing: border-box;
    padding: 0 10px;
}

.contact-bar {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    font-family: 'Arial', sans-serif;
    background: #4bbfae;
    padding: 12px 20px;
    border-radius: 8px;
    color: white;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0 auto;
}

.contact-text {
    font-weight: bold;
    flex: 1;
    min-width: 200px;
    font-size: clamp(14px, 2vw, 16px);
}

.contact-links {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    min-width: 0;
}

.contact-btn {
    text-decoration: none;
    color: white;
    font-weight: bold;
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 12px;
    border-radius: 5px;
    white-space: nowrap;
    text-align: center;
    font-size: clamp(12px, 2vw, 15px);
}

@media (max-width: 768px) {
    .contact-bar {
        flex-direction: column;
        padding: 15px;
        gap: 12px;
        text-align: center;
    }
    
    .contact-text {
        width: 100%;
        margin-bottom: 5px;
        white-space: normal;
        word-break: break-word;
    }
    
    .contact-links {
        width: 100%;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }
    
    .contact-btn {
        width: 100%;
        max-width: 100%;
        white-space: normal;
        padding: 10px;
        box-sizing: border-box;
    }
}

@media (max-width: 480px) {
    .contact-container {
        padding: 0 5px;
    }
    
    .contact-bar {
        padding: 12px 10px;
    }
    
    .contact-btn {
        font-size: 14px;
    }
}
</style>				</div>
				<!-- /.topbar-text -->
			
			
			<div class="social-icons"><a href="https://facebook.com/ixooweb" data-tooltip="Facebook" target="_blank"><i class="slab-logo-fb-simple"></i></a><a href="https://in.pinterest.com/ixooweb/" data-tooltip="Pinterest" target="_blank"><i class="slab-logo-instagram"></i></a><a href="https://instagram.com/ixooweb" data-tooltip="Twitter" target="_blank"><i class="slab-logo-pinterest"></i></a><a href="https://g.co/kgs/54a3MEs" data-tooltip="Google My Business" target="_blank"><i class="slab-google"></i></a><a href="https://www.linkedin.com/company/ixooweb-it-solution" data-tooltip="Linkedin" target="_blank"><i class="slab-logo-linkedin"></i></a></div>		</div>
	</div>

<div id="site-header" class="site-header header-style4 header-full header-shadow header-transparent">
	<div class="site-header-inner wrap">
		
		<div class="wrap-brand">
			<div class="header-brand">
				<a href="index.htm">
					<img src="{{asset('front_assets/wp-content/uploads/2025/03/ixooweb-logo-neww.png')}}" srcset="{{asset('front_assets/wp-content/uploads/2025/03/ixooweb-logo-neww.png 1x')}}, {{asset('front_assets/wp-content/uploads/2025/03/ixooweb-logo-neww.png 2x')}}" alt="Ixooweb IT Solutiom" class="logo logoDefault">				</a>	
			</div>
			
<nav class="navigator" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
<ul id="menu-main-menu" class="menu menu-primary">
    <li id="menu-item-1519" class="megamenu columns-5 menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-9 current_page_item menu-item-1519"><a href="index.htm" aria-current="page">Home</a></li>

@foreach($categories as $category)
    @if($category->subcategories->isNotEmpty())
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
            <a href="#">{{ ucfirst($category->name) }}</a>
            <ul class="sub-menu">
                @foreach($category->subcategories as $subcategory)
                    <li class="menu-item">
                        <a href="{{ url($subcategory->slug) }}">{{ $subcategory->name }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endif
	@endforeach

</ul>			</nav>
		</div>

					<ul class="navigator menu-extras">
									<li class="search-box">
	<a href="#">
		<i class="iconlab-Search-02-1"></i>
	</a>
	<div class="widget widget_search"><form role="search" method="get" class="search-form" action="https://ixooweb.top/">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s">
				</label>
				<input type="submit" class="search-submit" value="Search">
			</form></div></li>							</ul>
		
		
		

					
	<a href="javascript:;" data-target="off-canvas-right" class="off-canvas-toggle">
		<span>Menu</span>
	</a>
			</div>
	<!-- /.site-header-inner -->
</div>
<!-- /.site-header -->
<div id="site-header-sticky" class=" site-header-sticky header-style4 header-full">
	<div class="site-header-inner wrap">
		
		<div class="wrap-brand">
			<div class="header-brand">
				<a href="index.htm" class="brand">
					<img src="{{asset('front_assets/wp-content/uploads/2025/03/ixooweb-logo-neww.png')}}" srcset="{{asset('front_assets/wp-content/uploads/2025/03/ixooweb-logo-neww.png 1x')}}, {{asset('front_assets/wp-content/uploads/2025/03/ixooweb-logo-neww.png 2x')}}" alt="Ixooweb IT Solutiom" class="logo logoDark">				</a>
			</div>
			
			<nav class="navigator" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
									<ul id="menu-main-menu-1" class="menu menu-primary"><li class="megamenu columns-5 menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-9 current_page_item menu-item-1519"><a href="index.htm" aria-current="page">Home</a></li>

@foreach($categories as $category)
    @if($category->subcategories->isNotEmpty())
        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
            <a href="#">{{ ucfirst($category->name) }}</a>
            <ul class="sub-menu">
                @foreach($category->subcategories as $subcategory)
                    <li class="menu-item">
                        <a href="{{ url($subcategory->slug) }}">{{ $subcategory->name }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    @endif
	@endforeach
</ul>							</nav>
		</div>

					<ul class="navigator menu-extras">
									<li class="search-box">
	<a href="#">
		<i class="iconlab-Search-02-1"></i>
	</a>
	<div class="widget widget_search"><form role="search" method="get" class="search-form" action="https://ixooweb.top/">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s">
				</label>
				<input type="submit" class="search-submit" value="Search">
			</form></div></li>							</ul>
		
		
					
	<a href="javascript:;" data-target="off-canvas-right" class="off-canvas-toggle">
		<span>Menu</span>
	</a>
			</div>
	<!-- /.site-header-inner -->
</div>
	<!-- /.site-header -->	