<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="@yield('meta-description')">
<meta name="author" content="{{$page->company->name}}">

@yield('pageMeta')
<title>@yield('title')</title>
<link href="{{mix('css/app.css', 'assets/build')}}" rel="stylesheet">
@if(strlen(trim($page->meta->gtm)))
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','{{$page->meta->gtm}}');</script>
	<!-- End Google Tag Manager -->
@endif