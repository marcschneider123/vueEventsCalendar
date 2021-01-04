<!DOCTYPE html>
<html lang="de">
<head>
    @include('_layouts.header')
</head>
<body id="page-top" class="{{$class ?? ''}}">
@if(strlen(trim($page->meta->gtm)))
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id={{$page->meta->gtm}}"
		height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->
@endif
<noscript>Bitte aktivieren Sie Javascript!</noscript>
	<div class="page-bg page-bg-blurry"></div>
	<div id="app" class="content">
		<back-to-top></back-to-top>
		@include('_layouts.top-nav')

		@yield('body')
	</div>
	@yield('staticBody')

	@include('_layouts.footer')
@include('_layouts.scripts')
</body>
</html>