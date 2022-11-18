<?php

namespace Juliana\Agenda\Application\Http\Api;

use Juliana\Agenda\Application\Http\Response;
use Juliana\Agenda\Domain\CreateContactService;
use Juliana\Agenda\Domain\ListContactsService;
use Juliana\Agenda\Domain\UpdateContactService;

class UpdateContactController
{
  private UpdateContactService $service;

    public function __construct(UpdateContactService $service)
    {
        $this->service = $service;
    }

    public function __invoke(int $id)
    {
        $this->service->update($id, $_POST);

        Response::plain(202, "")->render();
    }
}