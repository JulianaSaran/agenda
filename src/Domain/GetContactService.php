<?php

namespace Juliana\Agenda\Domain;

use Juliana\Agenda\Domain\Address\Address;
use Juliana\Agenda\Domain\Address\AddressRepository;

class GetContactService
{
    private ContactRepository $repository;
    private AddressRepository $addressRepository;

    /**
     * Constroi a classe de serviço covertendo os parametros do construtor em propriedades da classe
     */
    public function __construct(ContactRepository $repository, AddressRepository $addressRepository)
    {
        $this->repository = $repository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * 1 - Recebe o Id e utiliza o repositorio de contato para carregar o contato desejado
     * 2 - Assim que temos o contato carregado, utilizamos ele para tentar
     *      carregar o endereço do repositorio de endereço
     * 3 - Constroi (instancia) um novo objeto que possui as propriedads do contato e o endereço
     *      para ser retornado na API
     */
    public function getContactDetailed(int $id): ContactDetailed
    {
        //Carrega o contato por Id
       $contact = $this->repository->loadById($id);

       //Carrega o endereco por Id
       $address = $this->addressRepository->findByContact($contact);

        //Instancia um novo objeto com propriedade do contato e do endereço
        return new ContactDetailed(
            id: $contact->id,
            name: $contact->name,
            phone: $contact->phone,
            observations: $contact->observations,
            address: $address,
        );
    }
}