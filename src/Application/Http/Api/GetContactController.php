<?php

namespace Juliana\Agenda\Application\Http\Api;

use Juliana\Agenda\Application\Http\Response;
use Juliana\Agenda\Domain\GetContactService;

class GetContactController
{
    private GetContactService $service;

    public function __construct(GetContactService $service)
    {
        $this->service = $service;
    }

    public function __invoke(int $id)
    {
        $contact = $this->service->getContactDetailed($id);

        Response::json(200, $contact)->render();
    }
}
