<?php

namespace Juliana\Agenda\Infra;

use Juliana\Agenda\Domain\Contact;
use Juliana\Agenda\Domain\ContactRepository;

class StaticContactRepository implements ContactRepository
{
    public function findAll(): array
    {
         $lista = [
            new Contact(1, "Juliana", "12365478", ""),
            new Contact(2, "Thiago", "564841658", "Amorzinho"),
            new Contact(3, "Jaime", "546987131", "Pai"),
        ];

         return $lista;
    }

    public function create(Contact $contact): void
    {
        // TODO: Implement save() method.
    }

    public function update(Contact $contact): void
    {
        // TODO: Implement update() method.
    }

    public function loadById(int $id): Contact
    {
        // TODO: Implement loadById() method.
    }

    public function delete(Contact $contact): void
    {
        // TODO: Implement delete() method.
    }
}