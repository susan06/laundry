<?php

namespace App\Repositories\Driver;

use App\Repositories\RepositoryInterface;

interface DriverRepository extends RepositoryInterface
{
    /**
     * update comission
     *
     * @param User user
     * @param array $data
     */
    public function create_update_comission($user, array $data);

    /**
     * create shedule
     *
     * @param array $data
     */
    public function create_shedule(array $data);

    /**
     * update shedule
     *
     * @param int $id
     * @param array $data
     */
    public function update_shedule($id, array $data);
    
    /**
     * delete shedule
     *
     * @param int $id
     */
    public function delete_shedule($id);

    /**
     * list and search activities by driver
     *
     * @param int $id
     * @param string $search
     */
    public function activities($id, $search = null);

    /**
     * create activity
     *
     * @param array $data
     */
    public function create_activity(array $data);

}