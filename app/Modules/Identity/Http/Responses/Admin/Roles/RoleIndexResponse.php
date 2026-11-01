<?php

namespace App\Modules\Identity\Http\Responses\Admin\Roles;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class RoleIndexResponse implements Responsable
{
    public function __construct(
        private readonly array $data = []
    ) {}

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse($this->data);
        }

        return view('livewire.admin.roles.roles-list', $this->data);
    }
}
