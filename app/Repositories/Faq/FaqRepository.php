<?php

namespace App\Repositories\Faq;

use App\Faq;
use App\Repositories\RepositoryInterface;

interface FaqRepository extends RepositoryInterface
{
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
    public function paginate_search($take = 10, $search = null);
}