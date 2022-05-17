
<div style="background:#F6F6F6; width:16rem; height:100vh; display:block; position:fixed; top:0; bottom:0; left:0;">
    <h2 class="text-xl font-bold text-black ml-4" style="margin-top:35%; margin-bottom:1rem">Tous les produits</h2>
    @foreach ($rayons as $rayon)
        <?php 
            $categories = App\Models\Category::where('rayon_id', $rayon->id)->get();
            foreach ($categories as $category) {
        ?>
            <x-menu-item :href="route('product_per_category', $category->slug)">{{ $category->title }}</x-menu-item>
        <?php } ?>

        <hr class="border-gray-800 mt-3 mb-3" style="margin-right:1rem; margin-left:1rem" />

    @endforeach
</div>