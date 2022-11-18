<?php

namespace Juliana\Agenda\Domain\Address;

use Juliana\Agenda\Domain\Contact;

interface AddressRepository
{
    public function findByContact(Contact $contact): ?Address;

    public function create(Contact $contact, Address $address): void;

    public function update(Contact $contact, Address $address): void;
}