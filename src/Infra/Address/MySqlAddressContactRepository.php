<?php

namespace Juliana\Agenda\Infra\Address;

use Juliana\Agenda\Domain\Address\Address;
use Juliana\Agenda\Domain\Address\AddressRepository;
use Juliana\Agenda\Domain\Contact;
use PDO;

class MySqlAddressContactRepository implements AddressRepository
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByContact(Contact $contact): ?Address
    {
        $query = "SELECT * FROM addresses WHERE contact_id = :contact_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":contact_id", $contact->id);
        $stmt->execute();
        $item = $stmt->fetch();

        if ($item === false) {
            return null;
        }

        return $this->addressContactFromItem($item);
    }

    public function create(Contact $contact, Address $address): void
    {
        $query = "INSERT INTO addresses (contact_id, street, number, neighborhood, postalCode) 
        VALUES (:contact_id, :street, :number, :neighborhood, :postalCode)";

        $stmt = $this->pdo->prepare($query);
//        $stmt->bindParam(":contact_id", $contact->id);
//        $stmt->bindParam(":street", $address->street);
//        $stmt->bindParam(":number", $address->number);
//        $stmt->bindParam(":neighborhood", $address->neighborhood);
//        $stmt->bindParam(":postalCode", $address->postalCode);

        $stmt->execute([
            ":contact_id" => $contact->id,
            ":street" => $address->street,
            ":number" => $address->number,
            ":neighborhood" => $address->neighborhood,
            ":postalCode" => $address->postalCode,
        ]);
    }

    public function update(Contact $contact, Address $address): void
    {
        $query = "UPDATE addresses SET 
                     street = :street, 
                     number = :number, 
                     neighborhood = :neighborhood,  
                     postalCode = :postalCode 
                 WHERE contact_id=:contact_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ":contact_id" => $contact->id,
            ":street" => $address->street,
            ":number" => $address->number,
            ":neighborhood" => $address->neighborhood,
            ":postalCode" => $address->postalCode,
        ]);
    }

    private function addressContactFromItem(array $item): Address
    {
        return new Address(
            street: $item["street"],
            number: $item["number"],
            neighborhood: $item["neighborhood"],
            postalCode: $item["postalcode"]
        );
    }
}