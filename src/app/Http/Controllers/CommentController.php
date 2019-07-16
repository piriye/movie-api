<?php

namespace App\Http\Controllers;

use App\Utilities\MovieApiException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utilities\ErrorCode;
use App\Services\CommentService;
use App\Helpers\ResponseHelper as Response;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function createComment(Request $request, int $movieId)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'message' => 'required|max:500',
        ]);

        if (!$validator->fails()) {
            try {
                $responseData = $this->commentService->createComment($movieId, $requestData);
                return Response::success($responseData, 'Successfully created comment');
            } catch (MovieApiException $ex) {
                return Response::error($ex->getMessage(), ErrorCode::BAD_REQUEST);
            }
        } else {
            $errorMessage = $validator->messages()->first();
            return Response::error(ErrorCode::INVALID_INPUT, $errorMessage, null);
        }
    }
}
