let mix = require('laravel-mix');
let build = require('./tasks/build.js');

// mix.disableSuccessNotifications();
mix.setPublicPath('source/assets/build');
mix.webpackConfig({
    plugins: [
        build.jigsaw,
        build.browserSync(process.env.MIX_BS_PROXY),
        build.watch(['source/**/*.md', 'source/**/*.php', 'source/**/*.scss', '!source/**/_tmp/*']),
    ]
});

mix.js('source/_assets/js/app.js', 'js')
	.extract()
	//specify load order
	// .autoload({
	// 	axios: ['axios']
	// });

mix.sass('source/_assets/sass/app.scss', 'css')
    .options({
        processCssUrls: false,
    });

/**
 * Minimize vendor size by removing unused packages
 */
mix.webpackConfig(webpack => {
	return {
		plugins: [
			// Ignore all locale files of moment.js
			new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
		]
	};
});

if (mix.inProduction()) {
	mix.version();
} else {
	//sourcemap fix
	mix.webpackConfig({ devtool: "inline-source-map" });
	mix.sourceMaps();
}