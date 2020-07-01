<?php

declare(strict_types=1);

namespace App\BasicRum\CoreObjects;

interface WriterHintInterface
{
    public function getTabledName(): string;

    public function getFieldName(): string;
}
