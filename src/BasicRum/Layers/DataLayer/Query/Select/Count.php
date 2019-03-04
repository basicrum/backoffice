<?php

declare(strict_types=1);

namespace App\BasicRum\Layers\DataLayer\Query\Select;

class Count
    implements \App\BasicRum\Layers\DataLayer\Query\SelectInterface
{

    /** @var string */
    private $entityName;

    /** @var string */
    private $fieldName;

    public function __construct(
        string $entityName,
        string $fieldName
    )
    {
        $this->entityName = $entityName;
        $this->fieldName  = $fieldName;
    }

    /**
     * @return array
     */
    public function getFields() : array
    {
        return ["COUNT({$this->entityName}.{$this->fieldName})"];
    }

}