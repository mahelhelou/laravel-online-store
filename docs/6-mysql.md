# MySQL in Laravel

## Laravel migrations

Now, we can just go to the phpMyAdmin application and create tables inside the online_store database (such as the product table). It can be done through the fill of a form. It is the traditional way. However, it has an issue, it does not allow us to have version control of our database tables and queries. If you have ever had to tell a teammate to manually add a table column to their local database schema after pulling in your changes from source control (such as GitHub), you have faced this issue.

Laravel migrations are like version control for our database.

### Product Migration

```bash
php artisan make:migration create_products_table
```

- Inside `database/migrations` folder, create a new file called replace the old code with the following: ```.
- The up method will create a new database table called products. By default, Laravel suggests creating the table names in plural. It is due to how the Laravel ORM “Eloquent” system works.
- The down method contains the opposite of the up method. It drops the products table.

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
  public function up() {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->text('description');
      $table->string('image');
      $table->integer('price');
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('products');
  }
}
```

## Execute the Migration

### Modify .env File

```env
DB_DATABASE=online_store
DB_USERNAME=root
DB_PASSWORD=
```

### Run the Migration

```bash
php artisan migrate
```

### Force DB Migration

```bash
# Try:
composer dump-autoload
php artisan config:cache

# If not working also try:
php artisan migrate:refresh.
```

## Add Products to the Database

- In the database of `online_store`, navigate to `SQL` and and run the following query:

```sql
INSERT INTO products
  (id, name, description, image, price, created_at, updated_at)
VALUES
  (NULL, 'TV', 'Best TV', 'game.png', '1000', '2021-10-01 00:00:00', '2021-10-01 00:00:00'),
  (NULL, 'iPhone', 'Best iPhone', 'safe.png', '999', '2021-10-01 00:00:00', '2021-10-01 00:00:00'),
  (NULL, 'Chromecast', 'Best Chromecast', 'submarine.png', '30', '2021-10-01 00:00:00', '2021-10-01 00:00:00'),
  (NULL, 'Glasses', 'Best Glasses', 'game.png', '100', '2021-10-01 00:00:00', '2021-10-01 00:00:00');
```
