<?php

return [
    'production' => false,
	'baseUrl' => '',
	// load remote collection https://github.com/tightenco/jigsaw-site/blob/master/source/docs/collections-remote-collections.md
    'collections' => [
    	'events' => [
//			'extends' => '_layouts.events',
			'items' => function() {
				$events = json_decode(file_get_contents('./source/assets/data/events.json'));
				
				return collect($events)->map(function ($event) {
					return [
						'title' => $event->title,
						'city' => $event->city,
						'location' => $event->location,
						'desc' => $event->desc,
						'date' => $event->date,
						'imap' => $event->imap,
					];
				});
			},
//			'path' => 'events/{title}',
//			'sort' => '-date'
		],
	],
	'meta' =>[
		//Google TagManager ID (leave empty, set in config.production)
		'gtm' => '',
	],
	'company' => [
		'name' => 'Vandelay Industries',
		'email' => 'info@vandelay-industries.example',
		'url' => 'https://www.vandelay-industries.example',
		'phone' => 'KL5-2390',
		'street' => '129 West 81st Street',
		'zip' => '10024',
		'city' => 'New York'
	],
];