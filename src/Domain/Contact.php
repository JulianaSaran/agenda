<?php

namespace Juliana\Agenda\Domain;

class Contact
{
    public int $id;
    public string $name;
    public string $phone;
    public string $observations;

    public function __construct(int $id, string $name, string $phone, string $observations)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->observations = $observations;
    }
}