<?php
/**
 * Custom Blade directives
 * @url http://jigsaw.tighten.co/docs/content-blade/
 * @url https://laravel.com/docs/5.6/blade#extending-blade
 */
/** @var \Illuminate\View\Compilers\BladeCompiler $bladeCompiler */


/**
 * prepend asset path to images
 * @usage <img src="@img(Header_desktop.jpg)" class="img-fluid" alt="Headerbild"/>
 */
$bladeCompiler->directive('img', function ($img) {
	return "/assets/images/$img";
});

/**
	@param class
	@example
		@button(['url' => '#'])
			Weiter
		@endbutton
 */
$bladeCompiler->component('_components.button', 'button');