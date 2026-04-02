<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [];
        
        for ($i = 1; $i <= 27; $i++) {
            $blogs[] = [
                'title_az' => "Kofe Hekayəsi $i",
                'title_en' => "Coffee Story $i",
                'title_ru' => "Кофейная история $i",
                'content_az' => "Bu kofe haqqında möhtəşəm bir məqalədir $i. Əgər siz əsl qəhvə sevənsinizsə, bu yazıda oxuyacağınız məlumatlar sizə ləzzət verəcək. Düzgün üyütmə, suyun temperaturu və ekstraksiya vaxtı barədə ətraflı məlumat burada.",
                'content_en' => "This is an amazing article about coffee $i. If you are a true coffee lover, the information in this article will delight you. Detailed info on proper grinding, water temperature, and extraction time is here.",
                'content_ru' => "Это потрясающая статья о кофе $i. Если вы настоящий ценитель кофе, информация в этой статье порадует вас. Здесь подробно описаны правильный помол, температура воды и время экстракции.",
                'category_az' => "Bələdçi",
                'category_en' => "Guide",
                'category_ru' => "Гид",
                'image_name' => "blog_$i.jpg", // Şəkil adları: blog_1.jpg, blog_2.jpg ... blog_27.jpg
                'date' => date('Y-m-d', strtotime("-$i days")),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('blogs')->insert($blogs);
    }
}
