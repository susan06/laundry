<?php

namespace App\Repositories\Driver;

use App\User;
use App\DriverComission;
use App\DriverShedule;
use App\DriverActivity;
use App\Repositories\Repository;

class EloquentDriver extends Repository implements DriverRepository
{
    /**
     * @var DriverActivityRepository
     */
    protected $activities;

	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentClient constructor
     *
     * @param Client $Client
     */
    public function __construct(
        User $driver, 
        DriverActivityRepository $activities
    )
    {
        parent::__construct($driver, $this->attributes);
        $this->activities = $activities;
    }

    /**
     * create or update comission
     *
     * @param User user
     * @param array $data
     */
    public function create_update_comission($user, array $data)
    {
        if ($user->driver_comission) {
            $comission = DriverComission::find($user->driver_comission->id);
            $comission->update([
                'percentage' => $data['percentage']
            ]);
        } else {
            $comission = DriverComission::create($data);
        }

        return $comission;
    }

    /**
     * create shedule
     *
     * @param array $data
     */
    public function create_shedule(array $data)
    {
        $shedule = DriverShedule::create($data);

        return $shedule;
    }

    /**
     * update shedule
     *
     * @param int $id
     * @param array $data
     */
    public function update_shedule($id, array $data)
    {
        $shedule = DriverShedule::find($id);
        $shedule->update($data);

        return $shedule;
    }

    /**
     * delete shedule
     *
     * @param int $id
     */
    public function delete_shedule($id)
    {
        $shedule = DriverShedule::destroy($id);

        return $shedule;
    }

    /**
     * list and search activities by driver
     *
     * @param int $id
     * @param string $search
     */
    public function activities($id, $search = null)
    {
        $query = DriverActivity::where('user_id', $id);

        if ($search) {
            $query->where('description', "like", "%{$search}%");
        }

        $result = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    /**
     * create activity
     *
     * @param array $data
     */
    public function create_activity(array $data)
    {
        return $this->activities->create($data);  
    }

}