<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default values for columns in table 'data_rows'
    |--------------------------------------------------------------------------
    | Define values:
    | 	https://user-images.githubusercontent.com/25877831/28218519-0e9cd8d0-68b9-11e7-8f1e-d3647c45634c.jpg
    |
    */
	'defaults' => [
		'type'	=> 'text',
		'required'	=> 0,
		'browse'	=> 1,
		'read'	=> 1,
		'edit'	=> 1,
		'add'	=> 1,
		'delete'	=> 1,
		'details'	=> '',
	],
    /*
    |--------------------------------------------------------------------------
    | Common columns
    |--------------------------------------------------------------------------
    |
    */
	'id' => [
		'type'	=> 'hidden',
		'required'	=> 1,
		'browse'	=> 0,
		'read'	=> 0,
		'edit'	=> 0,
		'add'	=> 0,
		'delete'	=> 0,
	],

	'created_at' => [
		'add'	=> 0,
	],

	'updated_at' => [
		'browse'	=> 0,
		'read'	=> 0,
		'edit'	=> 0,
		'add'	=> 0,
		'delete'	=> 0,
	],

    /*
    |--------------------------------------------------------------------------
    | Specific columns
    |--------------------------------------------------------------------------
    |
    */
	'slug' => [
		'type'	=> 'hidden',
	],
	'title' => [
		'display_name'	=> 'Title',
	],
	'description' => [
		'type'	=> 'text_area',
	],
	'image' => [
		'type'	=> 'image',
	],


];
