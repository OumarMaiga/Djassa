<?php

    namespace App\Repositories;

    use App\Models\Rayon;

    class RayonRepository extends ResourceRepository {

        public function __construct(Rayon $rayon) {
            $this->model = $rayon;
        }

    }