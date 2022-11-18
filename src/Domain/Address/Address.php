<?php

namespace Juliana\Agenda\Domain\Address;

class Address
{
    public string $street;
    public string $number;
    public string $neighborhood;
    public string $postalCode;

    public function __construct(string $street, string $number, string $neighborhood, string $postalCode)
    {
        $this->street = $street;
        $this->number = $number;
        $this->neighborhood = $neighborhood;
        $this->postalCode = $postalCode;
    }
}