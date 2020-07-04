<?php

declare(strict_types=1);

namespace App\BasicRum\CoreObjects\TechnicalMetrics\DnsDuration;

use App\BasicRum\CoreObjects\WriterHintInterface;

class WriterHint implements WriterHintInterface
{
    public function getFieldName(): string
    {
        return 'dns_duration';
    }

    public function getTabledName(): string
    {
        return 'rum_data_flat';
    }
}
