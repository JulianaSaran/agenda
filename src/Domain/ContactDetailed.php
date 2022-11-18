<?php

namespace Juliana\Agenda\Domain;

use Juliana\Agenda\Domain\Address\Address;

class ContactDetailed
{
    public int $id;
    public string $name;
    public string $phone;
    public string $observations;
    public ?Address $address;

    public function __construct(int $id, string $name, string $phone, string $observations, ?Address $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->observations = $observations;
        $this->address = $address;
    }
}