<?php

    namespace App\Repositories;

    use App\Models\Product;

    class ProductRepository extends ResourceRepository {

        public function __construct(Product $product) {
            $this->model = $product;
        }

    }