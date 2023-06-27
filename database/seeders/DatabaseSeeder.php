<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create([
        //     'name'=> 'Liliani Ledoh',
        //     'email'=>'lililedoh18@gmail.com',
        //     'password'=>bcrypt('12345')
        // ]);
        // User::create([
        //     'name'=> 'Queen Prog',
        //     'email'=>'queen@gmail.com',
        //     'password'=>bcrypt('12345')
        // ]);

        // User::factory(3)->create();

        // Category::create([
        //     'name'=>'Web Programming',
        //     'slug'=>'web-programming'
        // ]);

        // Category::create([
        //     'name'=>'Design',
        //     'slug'=>'design'
        // ]);
        // Category::create([
        //     'name'=>'Personal',
        //     'slug'=>'personal'
        // ]);

        // Post::factory(20)->create();

        // Post::create([
        //     'title'=> 'Judul Pertama',
        //     'slug'=>'judul-pertama',
        //     'excerpt'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk.',
        //     'body'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk. Hingga malam menyapa beliau tidak sedikitpun mencari keluarganya. Saat istri dan anaknya kembali membawa makan, “Ini makan buat saya, kan!” membentak hingga anaknya menangis dan diam karena takut dipukuli. Hanya diam dan sabar yang mereka lakukan setiap hari melawan ‘Pak Jum’.
        //     Malam sunyi itu, dia marah karena tak ada uang sepeserpun di almari. Dia mencaci dan memukuli istrinya hingga berdarah-darah. “Ayah hanya bisa meminta tak pernah bekerja! Menghamburkan uang dan menyiksa kami! Hati ayah batu!” anaknya menjerit menangis bersujud di telap kaki ayahnya menghentikan penyiksaan.  ',
        //     'category_id'=> 1,
        //     'user_id'=>1,

        // ]);
        // Post::create([
        //     'title'=> 'Judul Ke Dua',
        //     'slug'=>'judul-ke-dua',
        //     'excerpt'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk.',
        //     'body'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk. Hingga malam menyapa beliau tidak sedikitpun mencari keluarganya. Saat istri dan anaknya kembali membawa makan, “Ini makan buat saya, kan!” membentak hingga anaknya menangis dan diam karena takut dipukuli. Hanya diam dan sabar yang mereka lakukan setiap hari melawan ‘Pak Jum’.
        //     Malam sunyi itu, dia marah karena tak ada uang sepeserpun di almari. Dia mencaci dan memukuli istrinya hingga berdarah-darah. “Ayah hanya bisa meminta tak pernah bekerja! Menghamburkan uang dan menyiksa kami! Hati ayah batu!” anaknya menjerit menangis bersujud di telap kaki ayahnya menghentikan penyiksaan.  ',
        //     'category_id'=> 1,
        //     'user_id'=>1,

        // ]);
        // Post::create([
        //     'title'=> 'Judul Ke Tiga',
        //     'slug'=>'judul-ke-tiga',
        //     'excerpt'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk.',
        //     'body'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk. Hingga malam menyapa beliau tidak sedikitpun mencari keluarganya. Saat istri dan anaknya kembali membawa makan, “Ini makan buat saya, kan!” membentak hingga anaknya menangis dan diam karena takut dipukuli. Hanya diam dan sabar yang mereka lakukan setiap hari melawan ‘Pak Jum’.
        //     Malam sunyi itu, dia marah karena tak ada uang sepeserpun di almari. Dia mencaci dan memukuli istrinya hingga berdarah-darah. “Ayah hanya bisa meminta tak pernah bekerja! Menghamburkan uang dan menyiksa kami! Hati ayah batu!” anaknya menjerit menangis bersujud di telap kaki ayahnya menghentikan penyiksaan.  ',
        //     'category_id'=> 2,
        //     'user_id'=>1,

        // ]);

        // Post::create([
        //     'title'=> 'Judul Ke Empat',
        //     'slug'=>'judul-ke-empat',
        //     'excerpt'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk.',
        //     'body'=>'Ketika terik membakar kulit pekerja keras. Beliau duduk santai dengan asap-asap  yang meyekat perokok pasif. Membuat hutang keluarga semakin menumpuk. Hingga malam menyapa beliau tidak sedikitpun mencari keluarganya. Saat istri dan anaknya kembali membawa makan, “Ini makan buat saya, kan!” membentak hingga anaknya menangis dan diam karena takut dipukuli. Hanya diam dan sabar yang mereka lakukan setiap hari melawan ‘Pak Jum’.
        //     Malam sunyi itu, dia marah karena tak ada uang sepeserpun di almari. Dia mencaci dan memukuli istrinya hingga berdarah-darah. “Ayah hanya bisa meminta tak pernah bekerja! Menghamburkan uang dan menyiksa kami! Hati ayah batu!” anaknya menjerit menangis bersujud di telap kaki ayahnya menghentikan penyiksaan.  ',
        //     'category_id'=> 2,
        //     'user_id'=>2,

        // ]);




    }
}
