<?php

namespace App\Http\Controllers\API;

use App\Enums\MessageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Services\LoginService;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private LoginService $loginService)
    {}

    public function login(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            $credentials = $request->only('email', 'password');
            $response = $this->loginService->login($credentials);

            if ($response['status']) {
                return $this->sendResponse($response['data'], $response['message'], $response['statusCode']);
            }

            return $this->sendError($response['message'], MessageEnum::USER_NOT_FOUND_MESSAGE, $response['statusCode']);

        } catch (Exception $ex) {
            DB::rollBack();
            return $this->sendError($ex->getMessage(), MessageEnum::ERROR_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
