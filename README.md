# Laravel Template Package
Template for development of packages for Laravel.

## Install
Download repository to laravel\packages\{vendor}\{PackageName}<br>
Search for "VoyagerSeeder" & replace with "PackageName" in files & file`s contents<br>
Add provider to app.php for package development<br>
Add alias to app.php for package development<br>
Add "psr-4" path to composer.json<br>

## Download

Create folder laravel\packages\vilbur\YourPackageName

``` bash
cd \packages\<vendor>\YourPackageName
git init
git remote add origin https://github.com/vilbur/laravel-template-package.git
git pull origin master
```

## Add to Laravel config\app.php

``` php
'providers' => [
	vilbur\VoyagerSeeder\Providers\VoyagerSeederServiceProvider::class,
],
'providers' => [
	'VoyagerSeeder' => vilbur\VoyagerSeeder\Facade\VoyagerSeeder::class,
],

```
## Add to composer.json

``` json
    "autoload": {
        "psr-4": {
            "vilbur\\VoyagerSeeder\\": "packages/vilbur/VoyagerSeeder/src",
        }
    },
    "autoload-dev": {
        "psr-4": {
            "vilbur\\VoyagerSeeder\\": "packages/vilbur/VoyagerSeeder/src",
        }
    },

```
