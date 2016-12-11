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

            $result = Faq::whereRaw(
                "MATCH(question, answer) AGAINST(? IN BOOLEAN MODE)", 
                array($search)
            )->paginate($take)->appends(['search' => $search]);

        } else {
            $result = Faq::paginate($take);

        }

        return $result;

    }

}