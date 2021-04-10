<?php

    use WordPlate\Acf\Fields\Repeater;
    use WordPlate\Acf\Fields\Url;
    use WordPlate\Acf\Location;

    // Custom Fields for Single Doc Post
    register_extended_field_group([
      'title' => 'Extra info',
      'fields' => [
        Repeater::make('Resources')
        ->instructions('Add useful links.')
        ->fields([
        Url::make('Resource'),
        ])
        ->min(1)
        ->collapsed('resource')
        ->buttonLabel('Add a resource')
        ->layout('table')
      ],
        'location' => [
          Location::if('post_type', 'docs'),
        ],
      ]); 