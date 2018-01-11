
# Voyager Seeder
Seed your models to [Voyager](https://laravelvoyager.com/) tables.<br>
Create BREADS & permissions for admin.

### Seed model to tables:
 - data_types
 - data_rows
 - permissions

## Install
Laravel 5.5

#### Add to Database\Seeds\DatabaseSeeder.php

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
