<?php

declare(strict_types=1);

namespace App\BasicRum\BusinessMetrics;

class PageViewsCount implements \App\BasicRum\Report\CountableInterface
{
    public function getSelectDataFieldName(): string
    {
        return 'rum_data_id';
    }

    public function getSelectTableName(): string
    {
        return 'rum_data_flat';
    }
}
