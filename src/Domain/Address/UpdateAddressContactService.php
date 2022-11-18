<?php

namespace Juliana\Agenda\Domain\Address;

use Juliana\Agenda\Domain\ContactRepository;

class UpdateAddressContactService
{
    private ContactRepository $contactRepository;
    private AddressRepository $addressRepository;

    public function __construct(ContactRepository $contactRepository, AddressRepository $repository)
    {
        $this->contactRepository = $contactRepository;
        $this->addressRepository = $repository;
    }

    public function update(int $contactId, array $data): void
    {
        //Criar endereço com dados da requisição
        $address = new Address(
            street: $data["street"],
            number: $data["number"],
            neighborhood: $data["neighborhood"],
            postalCode: $data["postalCode"]
        );

        // carregar contato do banco dados - loadById
        $contact = $this->contactRepository->loadById($contactId);

        // carregar endereço do contato
        $existing = $this->addressRepository->findByContact($contact);

        // se o endereço do contato for nulo, então atualiza, se não cria endereço
        if ($existing !== null) {

            $this->addressRepository->update($contact, $address);

            return;
        }

        $this->addressRepository->create($contact, $address);

    }
}