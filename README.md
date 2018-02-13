
# Voyager Seeder
Seed your models to [Voyager](https://laravelvoyager.com/) tables.<br>
Create BREADS & permissions for tables.

### Seed to tables:
 - data_types
 - data_rows
 - permissions

## Install
Laravel 5.5

``` bash
php artisan vendor:publish
```
#### Add to seeder
__Database\Seeds\DatabaseSeeder.php__

``` php
    public function run()
    {
        $this->call(VoyagerSeeder::class);
    }
   ```
#### Publish config files

``` bash
php artisan vendor:publish
```
