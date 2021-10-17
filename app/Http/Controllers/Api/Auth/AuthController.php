<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignInRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Services\Auth\AuthService;
use App\Services\Auth\Dto\SignInDto;
use App\Services\Auth\Dto\SignUpDto;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      description="Sign In",
     *      path="/auth/sign-in",
     *      tags={"Auth"},
     *
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="password", type="string"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="token", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="errors", type="object")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param SignInRequest $request
     * @param AuthService $service
     * @return JsonResponse
     * @throws Exception
     */
    public function signIn(
        SignInRequest $request,
        AuthService   $service
    ): JsonResponse {
        return response()->success([
            'message' => trans('auth.success'),
            'token' => $service->signIn(new SignInDto(
                $request->email,
                $request->password,
                $request->ip(),
            )),
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * @OA\Post(
     *      description="Sign Up",
     *      path="/auth/sign-up",
     *      tags={"Auth"},
     *
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="passwordConfirm", type="string"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="messsage", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="errors", type="object")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param SignUpRequest $request
     * @param AuthService $service
     * @return JsonResponse
     * @throws Exception
     */
    public function signUp(
        SignUpRequest $request,
        AuthService   $service
    ): JsonResponse {
        return response()->successMessage([
            'message' => $service->signUp(
                new SignUpDto(
                    $request->firstName,
                    $request->lastName,
                    $request->phone,
                    $request->email,
                    $request->password
                )
            ),
        ], ResponseAlias::HTTP_CREATED);
    }
}
