# wp-fizz-custom

## Notes

This plugin is just a tiny boilerplate plugin to help organize the creation of a custom post type and its associated templates, custom fields and custom taxonomies. It's meant to work well with my starter theme (WP Fizz) and my page builder plugin (WP Fizz Builder), however it's still a work in progress — I'll update the different pages as soon as possible.

It is inspired by Joe Chellman's code.

This plugin requires [Timber](https://timber.github.io/docs/). 

It also requires a couple of libraries:
* [Extended CPTs by JohnBillion](wp-fizz-custom-main)
* [Extended ACF by WordPlate](https://github.com/wordplate/extended-acf)

To install these libraries, you can download this repo, navigate to this plugin folder using the command line and run:
```
$ composer install
```

Besides, you may delete the content located under `custom-fields`, `custom-taxonomies` and `custom-post-types` (the content there is actually just given as an example)
