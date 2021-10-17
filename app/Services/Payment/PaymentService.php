<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Services\Payment\Dto\MakePaymentDto;
use Exception;

class PaymentService
{
    /**
     * @param MakePaymentDto $dto
     * @return Payment
     * @throws Exception
     */
    public function makePayment
    (
        MakePaymentDto $dto
    ): Payment {
        try {
            return Payment::create([
                'user_id' => $dto->getUserId(),
                'amount' => $dto->getAmount(),
                'description' => $dto->getDescription(),
                'status' => $dto->getStatus(),
            ]);
        } catch (Exception $e) {
            throw new Exception(trans('payment.creation.failed'));
        }
    }
}
