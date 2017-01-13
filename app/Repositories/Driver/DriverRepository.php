<?php

namespace App\Repositories\Driver;

use App\Repositories\RepositoryInterface;

interface DriverRepository extends RepositoryInterface
{
    /**
     * update comission
     *
     * @param array $newData
     */
    public function update_comission($id, array $newData);

    /**
     * update shedule
     *
     * @param array $newData
     */
    public function update_shedule($id, array $newData);
}