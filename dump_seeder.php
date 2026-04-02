<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$products = \App\Models\Product::all()->toArray();
$blogs = \App\Models\Blog::all()->toArray();
$users = \App\Models\User::all()->toArray();

$seederContent = "<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    public function run()
    {
        $users = json_decode('".addslashes(json_encode($users))."', true);
        $products = json_decode('".addslashes(json_encode($products))."', true);
        $blogs = json_decode('".addslashes(json_encode($blogs))."', true);

        if(count($users) > 0) DB::table('users')->insert($users);
        if(count($products) > 0) DB::table('products')->insert($products);
        if(count($blogs) > 0) DB::table('blogs')->insert($blogs);
    }
}
";

file_put_contents(__DIR__.'/database/seeders/ProductionSeeder.php', $seederContent);
echo "Sizin lokal MySQL baze-anizdaki melumatlar (Mehsullar, Bloqlar ve Admin Hesabi) ugurla ProductionSeeder.php-ye arxivlesdirildi! Yekun ucum hazirdir.";
