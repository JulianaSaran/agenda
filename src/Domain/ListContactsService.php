<?php

namespace Juliana\Agenda\Domain;

class ListContactsService
{
    private ContactRepository $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array<Contact>
     */
    public function getAll()
    {
        return $this->repository->findAll();
    }
}