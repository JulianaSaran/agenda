<?php

namespace Juliana\Agenda\Application\Http\Api;

use Juliana\Agenda\Application\Http\Response;
use Juliana\Agenda\Domain\ListContactsService;

class ListContactsController
{
    private ListContactsService $service;

    public function __construct(ListContactsService $service)
    {
        $this->service = $service;
    }

    public function __invoke()
    {
        $contacts = $this->service->getAll();

         Response::json(200, $contacts)->render();
    }
}
