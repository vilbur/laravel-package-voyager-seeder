<?php


Route::get('/VoyagerSeeder', function () {
    return vilbur\VoyagerSeeder\VoyagerSeeder::test();
});