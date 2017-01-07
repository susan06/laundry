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

    /**
     * Paginate and search
     *
     * return the result paginated for the take value and with the attributes.
     *
     * @param int $take
     * @param string $search
     *
     * @return mixed
     *
     */
    public function paginate_search($take = 10, $search = null)
    {
        $query = Suggestion::query();

        if ($search) {
            $query->where('content', 'like', "%{$search}%");
        }

        $result = $query->paginate($take);

        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

}