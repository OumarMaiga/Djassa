<?php

    namespace App\Repositories;

    use App\Models\SubCategory;

    class SubCategoryRepository extends ResourceRepository {

        public function __construct(SubCategory $subCategory) {
            $this->model = $subCategory;
        }

    }