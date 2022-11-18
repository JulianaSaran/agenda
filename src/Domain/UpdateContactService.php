<?php

namespace Juliana\Agenda\Domain;

class UpdateContactService
{
    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update(int $id, array $data): void
    {
        $contact = new Contact($id, $data["name"], $data["phone"], $data["observations"]);

        $this->repository->update($contact);
    }
}
