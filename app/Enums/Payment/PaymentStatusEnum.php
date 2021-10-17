<?php

namespace App\Enums\Payment;

use App\Enums\BaseEnum;

class PaymentStatusEnum extends BaseEnum
{
    public const PENDING = 'pending';
    public const FAILED = 'failed';
    public const SUCCEED = 'succeed';
    public const CANCELED = 'canceled';
}
