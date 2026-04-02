<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    public function run()
    {
        $users = json_decode(file_get_contents(base_path('users.json')), true);
        $products = json_decode(file_get_contents(base_path('products.json')), true);
        $blogs = json_decode(file_get_contents(base_path('blogs.json')), true);

        if(!empty($users)) DB::table('users')->insertOrIgnore($users);
        if(!empty($products)) DB::table('products')->insertOrIgnore($products);
        if(!empty($blogs)) DB::table('blogs')->insertOrIgnore($blogs);

        if(env('DB_CONNECTION') === 'pgsql') {
            DB::statement("SELECT setval('users_id_seq', (SELECT MAX(id) FROM users));");
            DB::statement("SELECT setval('products_id_seq', (SELECT MAX(id) FROM products));");
            DB::statement("SELECT setval('blogs_id_seq', (SELECT MAX(id) FROM blogs));");
        }
    }
}
