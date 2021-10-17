<?php

namespace App\Enums;

use ReflectionClass;

abstract class BaseEnum
{
    public function toArray(): array
    {
        $class = new ReflectionClass(get_called_class());
        return $class->getConstants();
    }
}
