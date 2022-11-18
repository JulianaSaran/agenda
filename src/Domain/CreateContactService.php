<?php

namespace Juliana\Agenda\Domain;

class CreateContactService
{
    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): void
    {
        $contact = new Contact(0, $data["name"], $data["phone"], $data["observations"]);

        $this->repository->create($contact);
    }
}
