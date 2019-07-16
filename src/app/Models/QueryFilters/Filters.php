<?php

namespace App\Models\QueryFilters;

use App\Interfaces\QueryFiltersInterface;

class Filters implements QueryFiltersInterface
{
    public function getFilteredResults($model, string $params)
    {
        $result = explode(':', $params);
        $characters = $model->where($result[0], $result[1])->get();

        $response['characters'] = $characters->toArray();
        $response['metadata']['count'] = $characters->count();

        return $response;
    }
}
