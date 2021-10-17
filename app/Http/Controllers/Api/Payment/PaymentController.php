<?php

namespace App\Http\Controllers\Api\Payment;

use App\Enums\Payment\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\MakePaymentRequest;
use App\Http\Resources\Payment\PaymentResource;
use App\Services\Payment\Dto\MakePaymentDto;
use App\Services\Payment\PaymentService;

class PaymentController extends Controller
{
    /**
     * @OA\Post(
     *      description="Make Payment",
     *      path="/payment/make",
     *      tags={"Payment"},
     *
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="amount", type="number", format="decimal"),
     *              @OA\Property(property="description", type="string"),
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="amount", type="number", format="double"),
     *              @OA\Property(property="description", type="string"),
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
     * @param MakePaymentRequest $request
     * @param PaymentService $service
     * @return PaymentResource
     */
    public function makePayment
    (
        MakePaymentRequest $request,
        PaymentService     $service
    ): PaymentResource
    {
        return PaymentResource::make(
            $service->makePayment(
                new MakePaymentDto(
                    $request->user()->id,
                    $request->amount,
                    $request->description,
                    PaymentStatusEnum::PENDING,
                )
            )
        );
    }
}
