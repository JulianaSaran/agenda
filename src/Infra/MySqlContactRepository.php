<?php

namespace Juliana\Agenda\Infra;

use Juliana\Agenda\Domain\Contact;
use Juliana\Agenda\Domain\ContactRepository;
use PDO;

class MySqlContactRepository implements ContactRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $query = "SELECT * FROM contacts";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $contacts = [];

        foreach ($stmt->fetchAll() as $item) {
            $contacts[] = $this->contactFromItem($item);
        }

        return $contacts;
    }

    public function create(Contact $contact): void
    {
        $query = "INSERT INTO contacts (name, phone, observations) VALUES(:name, :phone, :observations)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":name", $contact->name);
        $stmt->bindParam(":phone", $contact->phone);
        $stmt->bindParam(":observations", $contact->observations);

        $stmt->execute();
    }

    public function update(Contact $contact): void
    {
        $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations, id = :id WHERE id = :id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":id", $contact->id);
        $stmt->bindParam(":name", $contact->name);
        $stmt->bindParam(":phone", $contact->phone);
        $stmt->bindParam(":observations", $contact->observations);
        $stmt->execute();
    }

    public function delete(Contact $contact): void
    {
        $query = 'DELETE FROM contacts WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $contact->id);
        $stmt->execute();
    }

    public function loadById(int $id): Contact
    {
        $query = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $item = $stmt->fetch();

        return $this->contactFromItem($item);
    }

    private function contactFromItem(array $item): Contact
    {
        return new Contact(
            id: $item["id"],
            name: $item["name"],
            phone: $item["phone"],
            observations: $item["observations"]
        );
    }
}