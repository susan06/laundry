<?php

namespace App\Repositories\Faq;

use App\Faq;
use App\Repositories\Repository;

class EloquentFaq extends Repository implements FaqRepository
{
	 /**
     * Fields attributes
     *
     * @var array
     */
    protected $attributes = ['question', 'answer'];

    /**
     * EloquentRole constructor
     *
     * @param Faq $faq
     */
    public function __construct(Faq $faq)
    {
        parent::__construct($faq, $this->attributes);
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
        if ($search) {

            $searchTerms = explode(' ', $search);
            $result = Faq::where( function ($q) use($searchTerms) {
                foreach ($searchTerms as $term) {
                   foreach ($this->attributes as $attribute) {
                        $q->orwhere($attribute, "like", "%{$term}%");
                    }
                }
            })->paginate($take)->appends(['search' => $search]);

        } else {
            $result = Faq::paginate($take);

        }

        return $result;

    }

}