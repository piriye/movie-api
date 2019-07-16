<?php

namespace App\Models\QueryFilters;

use App\Interfaces\QueryFiltersInterface;

class OrderBy implements QueryFiltersInterface
{
    public function getFilteredResults($model, string $params)
    {
        $result = explode(':', $params);
        $characters = $model->orderBy($result[0], $result[1])->get();

        $response['characters'] = $characters->toArray();
        $response['metadata']['count'] = $characters->count();

        return $response;
    }
}
