# wp-fizz-custom

##Notes

This plugin is just a tiny helper plugin to help organize the creation of custom post types, custom fields and custom taxonomies.

It is inspired by Joe Chellman's code.

My version requires a couple of libraries:
* [Extended CPTs by JohnBillion](wp-fizz-custom-main)
* [Extended ACF by WordPlate](https://github.com/wordplate/extended-acf)

If you don't have these plugins installed in your theme, you can just download this repo in `/plugins/`and run:
```
$ composer install
```

Otherwise, you can delete the files located under `custom-fields`, `custom-taxonomies`and `custom-post-types` (the files there are actually just given as examples)