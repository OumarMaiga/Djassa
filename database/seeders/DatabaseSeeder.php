<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use \App\Models\User;
use \App\Models\Category;
use \App\Models\SubCategory;
use \App\Models\SubSubCategory;
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
            'rayon_id' => 1,
        ])->save();

        SubCategory::create([
            'title' => 'Fruit',
            'slug' => Str::slug('Fruit'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
        ])->save();

        SubSubCategory::create([
            'title' => 'Pomme & Poires',
            'slug' => Str::slug('Pomme & Poires'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ])->save();

        SubSubCategory::create([
            'title' => 'Fruits Rouge, raisin',
            'slug' => Str::slug('Fruits Rouge, raisin'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ])->save();

        SubSubCategory::create([
            'title' => 'Melon, fruit à noyau',
            'slug' => Str::slug('Melon, fruit à noyau'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ])->save();

        SubSubCategory::create([
            'title' => 'Bananes',
            'slug' => Str::slug('Bananes'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 1,
        ])->save();

        SubCategory::create([
            'title' => 'Légumes',
            'slug' => Str::slug('Légumes'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
        ])->save();

        SubSubCategory::create([
            'title' => 'Tomates',
            'slug' => Str::slug('Tomates'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 2,
        ])->save();

        SubSubCategory::create([
            'title' => 'Concombres & Avocats',
            'slug' => Str::slug('Concombres & Avocats'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 2,
        ])->save();

        SubSubCategory::create([
            'title' => 'Champignons',
            'slug' => Str::slug('Champignons'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 2,
        ])->save();

        SubSubCategory::create([
            'title' => 'Haricots, Mais & autre legumes',
            'slug' => Str::slug('Haricots, Mais & autre legumes'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 2,
        ])->save();

        SubCategory::create([
            'title' => 'Légume à racine',
            'slug' => Str::slug('Légume à racine'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
        ])->save();

        SubSubCategory::create([
            'title' => 'Pomme de terre',
            'slug' => Str::slug('Pomme de terre'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 3,
        ])->save();

        SubSubCategory::create([
            'title' => 'Carottes',
            'slug' => Str::slug('Carottes'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 3,
        ])->save();

        SubSubCategory::create([
            'title' => 'Celeris',
            'slug' => Str::slug('Celeris'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 1,
            'sub_category_id' => 3,
        ])->save();
 
        Category::create([
            'title' => 'Viandes & Poissons ',
            'slug' => Str::slug('Viandes & Poissons'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
        ])->save();

        SubCategory::create([
            'title' => 'Boucherie',
            'slug' => Str::slug('Boucherie'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 2,
        ])->save();

        SubSubCategory::create([
            'title' => 'Boeuf',
            'slug' => Str::slug('Boeuf'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 2,
            'sub_category_id' => 4,
        ])->save();

        SubSubCategory::create([
            'title' => 'Porc & Mix',
            'slug' => Str::slug('Porc & Mix'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 2,
            'sub_category_id' => 4,
        ])->save();

        SubCategory::create([
            'title' => 'Poissons',
            'slug' => Str::slug('Poissons'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 2,
        ])->save();

        SubSubCategory::create([
            'title' => 'Poisson frais & Coquillage',
            'slug' => Str::slug('Poisson frais & Coquillage'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 2,
            'sub_category_id' => 4,
        ])->save();

        SubSubCategory::create([
            'title' => 'Autres produit de la mer',
            'slug' => Str::slug('Autres produit de la mer'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
            'category_id' => 2,
            'sub_category_id' => 4,
        ])->save();
 
        Category::create([
            'title' => 'Produits laitiers et oeufs ',
            'slug' => Str::slug('Produits laitiers et oeufs'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
        ])->save();
 
        Category::create([
            'title' => 'Boulangerie & Pâtisserie ',
            'slug' => Str::slug('Boulangerie & Pâtisserie'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 1,
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
            'rayon_id' => 2,
        ])->save();

        SubCategory::create([
            'title' => 'Chocolats',
            'slug' => Str::slug('Chocolats'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
            'category_id' => 5,
        ])->save();

        SubSubCategory::create([
            'title' => 'Tablette de chocolat',
            'slug' => Str::slug('Tablette de chocolat'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
            'category_id' => 5,
            'sub_category_id' => 5,
        ])->save();

        SubSubCategory::create([
            'title' => 'Bonbon & Sucettes',
            'slug' => Str::slug('Bonbon & Sucettes'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
            'category_id' => 5,
            'sub_category_id' => 5,
        ])->save();

        SubCategory::create([
            'title' => 'Biscuits',
            'slug' => Str::slug('Biscuits'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
            'category_id' => 5,
        ])->save();

        SubSubCategory::create([
            'title' => 'Biscuit aux fruits',
            'slug' => Str::slug('Biscuit aux fruits'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
            'category_id' => 5,
            'sub_category_id' => 5,
        ])->save();
 
        Category::create([
            'title' => 'Epicerie salée  ',
            'slug' => Str::slug('Epicerie salée'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
        ])->save();
 
        Category::create([
            'title' => 'Surgelés  ',
            'slug' => Str::slug('Surgelés'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
        ])->save();
 
        Category::create([
            'title' => 'Boissons, Café & Thé  ',
            'slug' => Str::slug('Boissons, Café & Thé'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
        ])->save();
 
        Category::create([
            'title' => 'Vins, Bières & Spititueux   ',
            'slug' => Str::slug('Vins, Bières & Spititueux'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 2,
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
            'rayon_id' => 3,
        ])->save();

        SubCategory::create([
            'title' => 'Alimentation infantile',
            'slug' => Str::slug('Alimentation infantile'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
            'category_id' => 10,
        ])->save();

        SubSubCategory::create([
            'title' => 'Lait & Céréales infantiles',
            'slug' => Str::slug('Lait & Céréales infantiles'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
            'category_id' => 10,
            'sub_category_id' => 6,
        ])->save();
 
        Category::create([
            'title' => 'Hygiène & Beauté  ',
            'slug' => Str::slug('Hygiène & Beauté'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
        ])->save();

        SubCategory::create([
            'title' => 'Soins du corps',
            'slug' => Str::slug('Soins du corps'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
            'category_id' => 11,
        ])->save();

        SubCategory::create([
            'title' => 'Cheveux',
            'slug' => Str::slug('Cheveux'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
            'category_id' => 11,
        ])->save();
 
        Category::create([
            'title' => 'Entretien & Nettoyage  ',
            'slug' => Str::slug('Entretien & Nettoyage'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
        ])->save();
 
        Category::create([
            'title' => 'Maisons & Equipements  ',
            'slug' => Str::slug('Maisons & Equipements'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
        ])->save();
 
        Category::create([
            'title' => 'Vêtements & Accessoires ',
            'slug' => Str::slug('Vêtements & Accessoires'),
            'etat' => 'enabled',
            'user_id' => 1,
            'rayon_id' => 3,
        ])->save();
    }
}
