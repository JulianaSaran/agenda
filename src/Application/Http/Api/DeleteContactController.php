<?php

namespace Juliana\Agenda\Application\Http\Api;

use Juliana\Agenda\Application\Http\Response;
use Juliana\Agenda\Domain\DeleteContactService;
use Juliana\Agenda\Domain\UpdateContactService;

class DeleteContactController
{
    private DeleteContactService $service;

    public function __construct(DeleteContactService $service)
    {
        $this->service = $service;
    }

    public function __invoke(int $id)
    {
        $this->service->delete($id);

        Response::plain(202, "")->render();
    }
}