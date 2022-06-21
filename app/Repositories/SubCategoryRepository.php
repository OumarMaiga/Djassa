<?php

    namespace App\Repositories;

    use App\Models\SubCategory;

    class SubCategoryRepository extends ResourceRepository {

        public function __construct(SubCategory $sub_category) {
            $this->model = $sub_category;
        }

    }