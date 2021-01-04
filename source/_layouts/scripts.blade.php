<script src="{{mix('js/manifest.js', 'assets/build')}}"></script>
<script src="{{mix('js/vendor.js', 'assets/build')}}"></script>
<script src="{{mix('js/app.js', 'assets/build')}}"></script>
{{-- page specific scripts --}}
@stack('pageScripts')
