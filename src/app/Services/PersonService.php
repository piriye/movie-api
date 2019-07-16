<?php

namespace App\Services;

use App\Models\Person;
use App\Models\QueryFilters\Filters;
use App\Models\QueryFilters\OrderBy;
use App\Utilities\ErrorCode;
use App\Utilities\MovieApiException;
use App\Utilities\Utils;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PersonService
{
    private $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws MovieApiException
     */
    public function createPerson(array $params)
    {
        Log::info('creating person - ' . json_encode($params));

        try {
            $params['height'] = is_numeric($params['height']) ? floatval($params['height']) : null;
            $params['mass'] = is_numeric($params['mass']) ? floatval($params['mass']) : null;

            $params['created'] = Carbon::parse(strtotime($params['created']));
            $params['edited'] = Carbon::parse(strtotime($params['edited']));

            return $this->person->firstOrCreate($params);
        } catch (QueryException $ex) {
            if ($ex->getCode() == 23000) {
                $errorMsg = 'attempting to create a duplicate person ' ;
                Log::debug($errorMsg . json_encode($params));
                throw new MovieApiException($errorMsg, ErrorCode::DUPLICATE_ENTRY);
            }

            throw new MovieApiException($ex->getMessage(), ErrorCode::INTERNAL_ERROR);
        }
    }

    public function getPeople($queryParamKey = null, $queryParamValue = null)
    {
        if (empty($queryParamKey)) {
            return $this->person->all();
        }

        $filters = [
            'filters' => Filters::class,
            'order_by' => OrderBy::class,
        ];

        $class = new $filters[$queryParamKey];

        $results = $class->getFilteredResults($this->person, $queryParamValue);
        return $this->getTotalHeight($results);
    }

    private function getTotalHeight(array $results)
    {
        $characters = $results['characters'];

        $totalHeight = 0;

        foreach ($characters as $character) {
            $totalHeight += $character['height'];
        }

        $ftNInches = Utils::convertToInches($totalHeight);

        $results['metadata']['total_height_in_cm'] = $totalHeight . 'cm';
        $results['metadata']['total_height_in_ft'] = $ftNInches['ft'] . 'ft and ' .
            $ftNInches['in'] . 'inches';

        return $results;
    }
}
