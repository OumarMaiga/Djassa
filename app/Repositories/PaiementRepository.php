<?php

    namespace App\Repositories;

    use App\Models\Paiement;

    class PaiementRepository extends ResourceRepository {

        public function __construct(Paiement $paiement) {
            $this->model = $paiement;
        }

    }