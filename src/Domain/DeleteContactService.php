<?php

namespace Juliana\Agenda\Domain;

class DeleteContactService
{
    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete(int $id): void
    {
        $contact = $this->repository->loadById($id);

        $this->repository->delete($contact);
    }
}