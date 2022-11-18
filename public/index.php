<?php

use Bramus\Router\Router;
use Juliana\Agenda\Application\Http\Api\Address\UpdateAddressContactController;
use Juliana\Agenda\Application\Http\Api\CreateContactController;
use Juliana\Agenda\Application\Http\Api\DeleteContactController;
use Juliana\Agenda\Application\Http\Api\GetContactController;
use Juliana\Agenda\Application\Http\Api\ListContactsController;
use Juliana\Agenda\Application\Http\Api\UpdateContactController;
use Juliana\Agenda\Domain\Address\AddressRepository;
use Juliana\Agenda\Domain\Address\UpdateAddressContactService;
use Juliana\Agenda\Domain\ContactRepository;
use Juliana\Agenda\Domain\CreateContactService;
use Juliana\Agenda\Domain\DeleteContactService;
use Juliana\Agenda\Domain\GetContactService;
use Juliana\Agenda\Domain\ListContactsService;
use Juliana\Agenda\Domain\UpdateContactService;
use Juliana\Agenda\Infra\Address\MySqlAddressContactRepository;
use Juliana\Agenda\Infra\MySqlContactRepository;
use Psr\Container\ContainerInterface;
use TinyContainer\TinyContainer;

include_once("../vendor/autoload.php");
$_SERVER['REQUEST_URI'] = str_replace("index.php/", "", $_SERVER['REQUEST_URI']);

$container = new TinyContainer([
    // Infra
    PDO::class => fn(ContainerInterface $container) => new PDO(
        "mysql:host=localhost;dbname=agenda",
        "root",
        "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    ),

    // Controllers -> camada de http, recebe requisições e retorna respostas
    ListContactsController::class => fn(ContainerInterface $container) => new ListContactsController(
        service: $container->get(ListContactsService::class),
    ),
    CreateContactController::class => fn(ContainerInterface $container) => new CreateContactController(
        service: $container->get(CreateContactService::class),
    ),
    GetContactController::class => fn(ContainerInterface $container) => new GetContactController(
        service: $container->get(GetContactService::class),
    ),
    UpdateContactController::class => fn(ContainerInterface $container) => new UpdateContactController(
        service: $container->get(UpdateContactService::class),
    ),
    DeleteContactController::class => fn(ContainerInterface $container) => new DeleteContactController(
        service: $container->get(DeleteContactService::class),
    ),
    UpdateAddressContactController::class => fn(ContainerInterface $container) => new UpdateAddressContactController(
        service: $container->get(UpdateAddressContactService::class),
    ),

    // Service -> processa regras de negocio
    ListContactsService::class => fn(ContainerInterface $container) => new ListContactsService(
        repository: $container->get(ContactRepository::class),
    ),
    CreateContactService::class => fn(ContainerInterface $container) => new CreateContactService(
        repository: $container->get(ContactRepository::class),
    ),
    GetContactService::class => fn(ContainerInterface $container) => new GetContactService(
        repository: $container->get(ContactRepository::class),
        addressRepository: $container->get(AddressRepository::class),
    ),
    UpdateContactService::class => fn(ContainerInterface $container) => new UpdateContactService(
        repository: $container->get(ContactRepository::class),
    ),
    DeleteContactService::class => fn(ContainerInterface $container) => new DeleteContactService(
        repository: $container->get(ContactRepository::class),
    ),
    UpdateAddressContactService::class => fn(ContainerInterface $container) => new UpdateAddressContactService(
        contactRepository: $container->get(ContactRepository::class),
        repository: $container->get(AddressRepository::class),
    ),

    // Repositories -> conecta no banco de dados
    ContactRepository::class => fn(ContainerInterface $container) => new MySqlContactRepository(
        pdo: $container->get(PDO::class),
    ),
    AddressRepository::class => fn(ContainerInterface $container) => new MySqlAddressContactRepository(
        pdo: $container->get(PDO::class),
    ),

]);

$router = new Router();
/**
 * fluxo da aplicação
 *   route -> controller -> service -> repository
 */
$router->post('/api/contacts/{id}/addresses', $container->get(UpdateAddressContactController::class));

$router->get('/api/contacts', $container->get(ListContactsController::class));
$router->post('/api/contacts', $container->get(CreateContactController::class));
$router->get('/api/contacts/{id}', $container->get(GetContactController::class));
$router->post('/api/contacts/{id}', $container->get(UpdateContactController::class));
$router->delete('/api/contacts/{id}', $container->get(DeleteContactController::class));



$router->get('/about', function () {
    echo 'About Page Contents';
});

$router->run();