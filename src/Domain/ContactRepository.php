<?php

namespace Juliana\Agenda\Domain;

interface ContactRepository
{
    public function loadById(int $id): Contact;

    /**
     * @return array<Contact>
     */
    public function findAll(): array;

    public function create(Contact $contact): void;

    public function update(Contact $contact): void;

    public function delete(Contact $contact): void;
}
