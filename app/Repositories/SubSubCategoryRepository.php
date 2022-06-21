<?php

    namespace App\Repositories;

    use App\Models\SubSubCategory;

    class SubSubCategoryRepository extends ResourceRepository {

        public function __construct(SubSubCategory $sub_sub_category) {
            $this->model = $sub_sub_category;
        }

    }