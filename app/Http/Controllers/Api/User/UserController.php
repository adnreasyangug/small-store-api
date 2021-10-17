<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Resources\Payment\PaymentResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\Dto\CreateUsersDto;
use App\Services\User\Dto\EditUsersDto;
use App\Services\User\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * @OA\Get (
     *      description="Get All Users",
     *      path="/users",
     *      tags={"User"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="billings", type="object"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param UserService $service
     * @return AnonymousResourceCollection
     * @throws Exception
     */
    public function index(
        UserService $service
    ): AnonymousResourceCollection
    {
        return UserResource::collection($service->getUsers());
    }

    /**
     * @OA\Get (
     *      description="Get User",
     *      path="/users/1",
     *      tags={"User"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="billings", type="object"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param User $user
     * @return UserResource
     */
    public function show(
        User $user
    ): UserResource
    {
        return UserResource::make($user);
    }

    /**
     * @OA\Post(
     *      description="Create User",
     *      path="/users",
     *      tags={"User"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="password", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="billings", type="object"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param CreateUserRequest $request
     * @param UserService $service
     * @return UserResource
     * @throws Exception
     */
    public function create(
        CreateUserRequest $request,
        UserService       $service
    ): UserResource {
        return UserResource::make(
            $service->createUser(
                new CreateUsersDto(
                    $request->firstName,
                    $request->lastName,
                    $request->email,
                    $request->phone,
                    $request->password,
                )
            )
        );
    }

    /**
     * @OA\Put(
     *      description="Edit User",
     *      path="/users/1",
     *      tags={"User"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string", format="email"),
     *              @OA\Property(property="phone", type="string"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *              @OA\Property(property="lastName", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="billings", type="object"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param User $user
     * @param EditUserRequest $request
     * @param UserService $service
     * @return UserResource
     * @throws Exception
     */
    public function edit(
        User $user,
        EditUserRequest $request,
        UserService     $service
    ): UserResource {
        return UserResource::make(
            $service->editUser(
                $user,
                new EditUsersDto(
                    $request->firstName,
                    $request->lastName,
                    $request->email,
                    $request->phone,
                )
            )
        );
    }

    /**
     * @OA\Delete(
     *      description="Delete User",
     *      path="/users/1",
     *      tags={"User"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Thowable message"
     *      ),
     * )
     *
     * @param User $user
     * @param UserService $service
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(
        User $user,
        UserService $service
    ): JsonResponse {
        return response()->successMessage($service->deleteUser($user));
    }

    /**
     * @OA\Get (
     *      description="Get All Payments of User",
     *      path="/users/1/payments",
     *      tags={"User"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="firstName", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string")
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
     * @param User $user
     * @return AnonymousResourceCollection
     */
    public function payments(
        User $user
    ): AnonymousResourceCollection {
        return PaymentResource::collection($user->payments);
    }
}
