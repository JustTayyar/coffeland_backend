<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // --- İÇKİLƏR (Drinks) ---
            
            // 1. Klassik Kofe (Coffee)
            ['name' => 'Espresso', 'category' => 'İçkilər', 'sub_category' => 'Klassik Kofe', 'price' => 3.50, 'description' => 'Saf, tünd və enerjili qəhvə.', 'image_url' => '/images/products/espresso.jpg'],
            ['name' => 'Americano', 'category' => 'İçkilər', 'sub_category' => 'Klassik Kofe', 'price' => 4.00, 'description' => 'Espresso və isti suyun mükəmməl balansı.', 'image_url' => '/images/products/americano.jpg'],
            ['name' => 'Latte', 'category' => 'İçkilər', 'sub_category' => 'Klassik Kofe', 'price' => 5.50, 'description' => 'Yüngül espresso və bol isti süd.', 'image_url' => '/images/products/latte.jpg'],
            ['name' => 'Cappuccino', 'category' => 'İçkilər', 'sub_category' => 'Klassik Kofe', 'price' => 5.50, 'description' => 'Espresso, isti süd və bol süd köpüyü.', 'image_url' => '/images/products/cappuccino.jpg'],
            ['name' => 'Flat White', 'category' => 'İçkilər', 'sub_category' => 'Klassik Kofe', 'price' => 6.00, 'description' => 'İkiqat espresso və yumşaq köpüklü süd.', 'image_url' => '/images/products/flat_white.jpg'],
            ['name' => 'Türk Qəhvəsi', 'category' => 'İçkilər', 'sub_category' => 'Klassik Kofe', 'price' => 3.00, 'description' => 'Ənənəvi üsulla hazırlanmış bol köpüklü qəhvə.', 'image_url' => '/images/products/turkish_coffee.jpg'],

            // 2. Soyuq kofelər (Iced Coffee)
            ['name' => 'Iced Latte', 'category' => 'İçkilər', 'sub_category' => 'Soyuq kofelər', 'price' => 6.00, 'description' => 'Buz, espresso və soyuq süd.', 'image_url' => '/images/products/iced_latte.jpg'],
            ['name' => 'Iced Americano', 'category' => 'İçkilər', 'sub_category' => 'Soyuq kofelər', 'price' => 4.50, 'description' => 'Buzlu su ilə sərinləşdirici espresso.', 'image_url' => '/images/products/iced_americano.jpg'],
            ['name' => 'Cold Brew', 'category' => 'İçkilər', 'sub_category' => 'Soyuq kofelər', 'price' => 5.50, 'description' => '12 saat soyuq suda dəmlənmiş tünd qəhvə.', 'image_url' => '/images/products/cold_brew.jpg'],
            ['name' => 'Frappe', 'category' => 'İçkilər', 'sub_category' => 'Soyuq kofelər', 'price' => 6.50, 'description' => 'Buzla qarışdırılmış köpüklü qəhvə ləzzəti.', 'image_url' => '/images/products/frappe.jpg'],

            // 3. Çaylar (Tea)
            ['name' => 'Qara çay', 'category' => 'İçkilər', 'sub_category' => 'Çaylar', 'price' => 2.00, 'description' => 'Klassik dəmləmə qara çay.', 'image_url' => '/images/products/black_tea.jpg'],
            ['name' => 'Yaşıl çay', 'category' => 'İçkilər', 'sub_category' => 'Çaylar', 'price' => 2.50, 'description' => 'Antioksidantlarla zəngin təbii yaşıl çay.', 'image_url' => '/images/products/green_tea.jpg'],
            ['name' => 'Bitki çayları', 'category' => 'İçkilər', 'sub_category' => 'Çaylar', 'price' => 3.00, 'description' => 'Rahatlaşdırıcı çobanyastığı və nanə qarışımı.', 'image_url' => '/images/products/herbal_tea.jpg'],
            ['name' => 'Matcha', 'category' => 'İçkilər', 'sub_category' => 'Çaylar', 'price' => 5.00, 'description' => 'Yapon toz yaşıl çayından xüsusi dəmləmə.', 'image_url' => '/images/products/matcha_tea.jpg'],

            // 4. Şirələr (Juices)
            ['name' => 'Təzə sıxılmış portağal', 'category' => 'İçkilər', 'sub_category' => 'Şirələr', 'price' => 4.50, 'description' => '100% təbii portağal şirəsi.', 'image_url' => '/images/products/orange_juice.jpg'],
            ['name' => 'Alma şirəsi', 'category' => 'İçkilər', 'sub_category' => 'Şirələr', 'price' => 4.00, 'description' => 'Təbii alma şirəsi.', 'image_url' => '/images/products/apple_juice.jpg'],
            ['name' => 'Qarışıq meyvə şirələri', 'category' => 'İçkilər', 'sub_category' => 'Şirələr', 'price' => 5.00, 'description' => 'Mövsüm meyvələrindən xüsusi qarışım.', 'image_url' => '/images/products/mixed_juice.jpg'],

            // 5. Milkshake və Smoothie
            ['name' => 'Çiyələk milkshake', 'category' => 'İçkilər', 'sub_category' => 'Milkshake və Smoothie', 'price' => 5.50, 'description' => 'Çiyələk, süd və dondurma qarışımı.', 'image_url' => '/images/products/strawberry_milkshake.jpg'],
            ['name' => 'Banan smoothie', 'category' => 'İçkilər', 'sub_category' => 'Milkshake və Smoothie', 'price' => 5.50, 'description' => 'Təzə banan və qatıqla hazırlanmış təbii smoothie.', 'image_url' => '/images/products/banana_smoothie.jpg'],
            ['name' => 'Şokolad milkshake', 'category' => 'İçkilər', 'sub_category' => 'Milkshake və Smoothie', 'price' => 6.00, 'description' => 'Qatı şokolad, süd və vanilli dondurma.', 'image_url' => '/images/products/chocolate_milkshake.jpg'],

            // 6. Digər isti içkilər
            ['name' => 'Hot Chocolate', 'category' => 'İçkilər', 'sub_category' => 'Digər isti içkilər', 'price' => 4.50, 'description' => 'İsti şokolad və üzərində marshmallow.', 'image_url' => '/images/products/hot_chocolate.jpg'],
            ['name' => 'White Chocolate', 'category' => 'İçkilər', 'sub_category' => 'Digər isti içkilər', 'price' => 5.00, 'description' => 'Ağ şokolad və isti süd.', 'image_url' => '/images/products/white_chocolate.jpg'],
            ['name' => 'Salep', 'category' => 'İçkilər', 'sub_category' => 'Digər isti içkilər', 'price' => 4.50, 'description' => 'Qışın imtina edilməz ləzzəti dondurma qatqısı ilə.', 'image_url' => '/images/products/salep.jpg'],

            // 7. Soft drinks
            ['name' => 'Coca‑Cola', 'category' => 'İçkilər', 'sub_category' => 'Soft drinks', 'price' => 2.50, 'description' => 'Klassik qazlı içki 330ml.', 'image_url' => '/images/products/coca_cola.jpg'],
            ['name' => 'Fanta', 'category' => 'İçkilər', 'sub_category' => 'Soft drinks', 'price' => 2.50, 'description' => 'Portağallı qazlı içki 330ml.', 'image_url' => '/images/products/fanta.jpg'],
            ['name' => 'Sprite', 'category' => 'İçkilər', 'sub_category' => 'Soft drinks', 'price' => 2.50, 'description' => 'Limonlu qazlı içki 330ml.', 'image_url' => '/images/products/sprite.jpg'],
            ['name' => 'Mineral su', 'category' => 'İçkilər', 'sub_category' => 'Soft drinks', 'price' => 2.00, 'description' => 'Təbii qazlı mineral su.', 'image_url' => '/images/products/mineral_water.jpg'],

            // 8. Su
            ['name' => 'Qazlı su', 'category' => 'İçkilər', 'sub_category' => 'Su', 'price' => 1.50, 'description' => 'Sadə qazlı su 500ml.', 'image_url' => '/images/products/sparkling_water.jpg'],
            ['name' => 'Qazsız su', 'category' => 'İçkilər', 'sub_category' => 'Su', 'price' => 1.00, 'description' => 'Təmiz içməli su 500ml.', 'image_url' => '/images/products/still_water.jpg'],

            // --- QİDALAR (Foods) ---

            // 1. Səhər yeməkləri (Breakfast)
            ['name' => 'Omlet', 'category' => 'Qidalar', 'sub_category' => 'Səhər yeməkləri', 'price' => 5.50, 'description' => '3 yumurta, pendir və tərəvəzlərlə.', 'image_url' => '/images/products/omelette.jpg'],
            ['name' => 'Pancake', 'category' => 'Qidalar', 'sub_category' => 'Səhər yeməkləri', 'price' => 6.00, 'description' => 'Üzərində ağcaqayın siropu ilə 3 qatlı pancake.', 'image_url' => '/images/products/pancake.jpg'],
            ['name' => 'Croissant', 'category' => 'Qidalar', 'sub_category' => 'Səhər yeməkləri', 'price' => 3.50, 'description' => 'Kərə yağı ilə bişirilmiş təzə kruassan.', 'image_url' => '/images/products/croissant.jpg'],
            ['name' => 'Avocado toast', 'category' => 'Qidalar', 'sub_category' => 'Səhər yeməkləri', 'price' => 7.00, 'description' => 'Çovdar çörəyi, əzilmiş avokado və pörtlədilmiş yumurta.', 'image_url' => '/images/products/avocado_toast.jpg'],

            // 2. Sendviç və Toastlar
            ['name' => 'Toyuqlu sendviç', 'category' => 'Qidalar', 'sub_category' => 'Sendviç və Toastlar', 'price' => 6.50, 'description' => 'Qril toyuq, kahı, pomidor və xüsusi sous.', 'image_url' => '/images/products/chicken_sandwich.jpg'],
            ['name' => 'Tuna sendviç', 'category' => 'Qidalar', 'sub_category' => 'Sendviç və Toastlar', 'price' => 7.00, 'description' => 'Tun balığı əzməsi, mayonez və şirin qarğıdalı.', 'image_url' => '/images/products/tuna_sandwich.jpg'],
            ['name' => 'Cheese toast', 'category' => 'Qidalar', 'sub_category' => 'Sendviç və Toastlar', 'price' => 4.50, 'description' => 'İki qat holland pendiri ilə qızarmış tost.', 'image_url' => '/images/products/cheese_toast.jpg'],
            ['name' => 'Club sandwich', 'category' => 'Qidalar', 'sub_category' => 'Sendviç və Toastlar', 'price' => 8.50, 'description' => 'Toyuq, vetçina, pendir, yumurta və kartof fri ilə.', 'image_url' => '/images/products/club_sandwich.jpg'],

            // 3. Desertlər (Desserts)
            ['name' => 'Cheesecake', 'category' => 'Qidalar', 'sub_category' => 'Desertlər', 'price' => 6.50, 'description' => 'Nyu-York üsulu, moruq və ya karamel sousu ilə.', 'image_url' => '/images/products/cheesecake.jpg'],
            ['name' => 'Brownie', 'category' => 'Qidalar', 'sub_category' => 'Desertlər', 'price' => 5.50, 'description' => 'İsti, şokoladlı brownie və vanilli dondurma.', 'image_url' => '/images/products/brownie.jpg'],
            ['name' => 'Tiramisu', 'category' => 'Qidalar', 'sub_category' => 'Desertlər', 'price' => 7.00, 'description' => 'Klassik İtalyan tarifi: maskarpone pendiri və qəhvə.', 'image_url' => '/images/products/tiramisu.jpg'],
            ['name' => 'Red Velvet Cake', 'category' => 'Qidalar', 'sub_category' => 'Desertlər', 'price' => 6.50, 'description' => 'Qırmızı məxmər keksi krem-pendir qlazurla.', 'image_url' => '/images/products/red_velvet.jpg'],

            // 4. Salatlar
            ['name' => 'Caesar Salad', 'category' => 'Qidalar', 'sub_category' => 'Salatlar', 'price' => 8.00, 'description' => 'Aysberq kahı, krutonlar, parmesan və Sezar sousu.', 'image_url' => '/images/products/caesar_salad.jpg'],
            ['name' => 'Greek Salad', 'category' => 'Qidalar', 'sub_category' => 'Salatlar', 'price' => 7.50, 'description' => 'Xiyar, pomidor, zeytun, feta pendiri və zeytun yağı.', 'image_url' => '/images/products/greek_salad.jpg'],
            ['name' => 'Toyuqlu salat', 'category' => 'Qidalar', 'sub_category' => 'Salatlar', 'price' => 9.00, 'description' => 'Qril toyuq lülələri, qarışıq göyərti və ballı xardal sousu.', 'image_url' => '/images/products/chicken_salad.jpg'],

            // 5. Yüngül yeməklər / Snack
            ['name' => 'Fries', 'category' => 'Qidalar', 'sub_category' => 'Yüngül yeməklər', 'price' => 3.50, 'description' => 'Xırtıldayan dondurulmuş kartof qızartması.', 'image_url' => '/images/products/fries.jpg'],
            ['name' => 'Nuggets', 'category' => 'Qidalar', 'sub_category' => 'Yüngül yeməklər', 'price' => 5.00, 'description' => 'Toyuq dənələri 6 ədəd xüsusi sousla.', 'image_url' => '/images/products/nuggets.jpg'],
            ['name' => 'Onion rings', 'category' => 'Qidalar', 'sub_category' => 'Yüngül yeməklər', 'price' => 4.50, 'description' => 'Qızarmış soğan halqaları.', 'image_url' => '/images/products/onion_rings.jpg'],
            ['name' => 'French fries', 'category' => 'Qidalar', 'sub_category' => 'Yüngül yeməklər', 'price' => 4.00, 'description' => 'Təbii ev üsulu qızardılmış kartof.', 'image_url' => '/images/products/french_fries.jpg'],

            // 6. Şirin səhər yeməkləri
            ['name' => 'Waffle', 'category' => 'Qidalar', 'sub_category' => 'Şirin səhər yeməkləri', 'price' => 6.50, 'description' => 'Belçika vafli, şokolad sousu, meyvələr və dondurma.', 'image_url' => '/images/products/waffle.jpg'],
            ['name' => 'Crepe', 'category' => 'Qidalar', 'sub_category' => 'Şirin səhər yeməkləri', 'price' => 5.50, 'description' => 'Nazik fransız blinçikləri nutella və bananla.', 'image_url' => '/images/products/crepe.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
