<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Helpers\ResponseHelper as Response;

class PersonController
{
    private $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function getPeople(Request $request)
    {
        $requestData = $request->all();

        if (!empty($requestData)) {
            $allowedQueryParams = ['filters', 'order_by'];

            foreach ($requestData as $key => $value) {
                if (in_array($key, $allowedQueryParams)) {
                    $people = $this->personService->getPeople($key, $request->get($key));
                    return Response::success($people, 'Successfully fetched characters');
                }
            }
        }

        $people = $this->personService->getPeople();
        return Response::success($people, 'Successfully fetched characters');
    }
}