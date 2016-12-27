<?php

namespace App\Repositories\Suggestion;

use App\Suggestion;
use App\Repositories\Repository;

class EloquentSuggestion extends Repository implements SuggestionRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * EloquentSuggestion constructor
     *
     * @param Suggestion $suggestion
     */
    public function __construct(Suggestion $suggestion)
    {
        parent::__construct($suggestion, $this->attributes);
    }

}