<?php namespace vilbur\VoyagerSeeder;

class VoyagerSeeder
{
    public static function test() {
        return \Config::get('VoyagerSeeder.config-test');
    }
}