<?php

namespace App\Repositories\Qualification;

use App\Repositories\RepositoryInterface;

interface QualificationRepository extends RepositoryInterface
{
     /**
     * create or update
     *
     * @param int $quantify
     */
    public function create_update($quantify);
}