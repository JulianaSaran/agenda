<?php

namespace Juliana\Agenda\Application\Http\Api;

use Juliana\Agenda\Application\Http\Response;
use Juliana\Agenda\Domain\CreateContactService;
use Juliana\Agenda\Domain\ListContactsService;

class CreateContactController
{
    private CreateContactService $service;

    public function __construct(CreateContactService $service)
    {
        $this->service = $service;
    }

    public function __invoke()
    {
        $this->service->create($_POST);

        Response::plain(201, "")->render();
    }
}