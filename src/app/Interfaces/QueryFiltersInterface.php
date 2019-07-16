<?php

namespace App\Interfaces;

interface QueryFiltersInterface
{
    public function getFilteredResults($model, string $params);
}