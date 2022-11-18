<?php

namespace Juliana\Agenda\Application\Http\Api\Address;

use Juliana\Agenda\Application\Http\Response;
use Juliana\Agenda\Domain\Address\UpdateAddressContactService;

class UpdateAddressContactController
{
    private UpdateAddressContactService $service;

    public function __construct(UpdateAddressContactService $service)
    {
        $this->service = $service;
    }

    public function __invoke(int $id)
    {
        $this->service->update($id, $_POST);

        Response::plain(200, "")->render();
    }

}
