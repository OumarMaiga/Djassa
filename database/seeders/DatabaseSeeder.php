<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use \App\Models\User;
use \App\Models\Category;
use \App\Models\Rayon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@djassa.com',
            'password' => Hash::make('password123'),
            'etat' => 'enabled',
            'type' => 'admin'
        ])->save();
 
        Rayon::create([
            'title' => 'Alimentation',
            'slug' => Str::slug('Alimentation'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();

        Category::create([
            'title' => 'Fruits & Légume',
            'slug' => Str::slug('Fruits & Légume'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Viandes & Poissons ',
            'slug' => Str::slug('Viandes & Poissons'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Produits laitiers et oeufs ',
            'slug' => Str::slug('Produits laitiers et oeufs'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Boulangerie & Pâtisserie ',
            'slug' => Str::slug('Boulangerie & Pâtisserie'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Rayon::create([
            'title' => 'Supermarché',
            'slug' => Str::slug('Supermarché'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();

        Category::create([
            'title' => 'Epicerie sucrée ',
            'slug' => Str::slug('Epicerie sucrée'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Epicerie salée  ',
            'slug' => Str::slug('Epicerie salée'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Surgelés  ',
            'slug' => Str::slug('Surgelés'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Boissons, Café & Thé  ',
            'slug' => Str::slug('Boissons, Café & Thé'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Vins, Bières & Spititueux   ',
            'slug' => Str::slug('Vins, Bières & Spititueux'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Rayon::create([
            'title' => 'Autres',
            'slug' => Str::slug('Autres'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();

        Category::create([
            'title' => 'Bébés & Enfants ',
            'slug' => Str::slug('Bébés & Enfants'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Hygiène & Beauté  ',
            'slug' => Str::slug('Hygiène & Beauté'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Entretien & Nettoyage  ',
            'slug' => Str::slug('Entretien & Nettoyage'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Maisons & Equipements  ',
            'slug' => Str::slug('Maisons & Equipements'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Vêtements & Accessoires ',
            'slug' => Str::slug('Vêtements & Accessoires'),
            'etat' => 'enabled',
            'user_id' => 1,
        ])->save();
    }
}
