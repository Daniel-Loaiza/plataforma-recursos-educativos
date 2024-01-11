<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creacion categorias de prueba
        //Category::factory()->count(5)->create();

        Category::create(['name'=>'PHP']);
        Category::create(['name'=>'Laravel']);
        Category::create(['name'=>'Inertia']);        
        Category::create(['name'=>'TailwindCSS']);
        Category::create(['name'=>'Vue.js']);

        foreach (Category::all() as $category) {
            Resource::factory()->count(5)->create([
                'category_id'=>$category->id
            ]);
        }

        //Creacion usuarios de prueba
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
