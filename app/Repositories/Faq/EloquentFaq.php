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

}