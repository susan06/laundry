<?php

namespace App\Repositories\Qualification;

use Auth;
use App\Qualification;
use App\Repositories\Repository;

class EloquentQualification extends Repository implements QualificationRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentQualificatio constructor
     *
     * @param Qualification $qualification
     */
    public function __construct(Qualification $qualification)
    {
        parent::__construct($qualification, $this->attributes);
    }

     /**
     * create or update
     *
     * @param int $quantify
     */
    public function create_update($quantify) 
    {
        $user = Auth::user();
        $qualification = $user->qualification;

        if ($qualification) {

            $model = $this->model->find($qualification->id);
            $qualifications = $model->update(['quantify' => $quantify]);

        } else {
            $qualifications = $this->model->create(['user_id' => $user->id, 'quantify' => $quantify]);
        }
        
        return $qualifications; 
    }

}