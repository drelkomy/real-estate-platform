<?php

namespace App\Modules\Identity\Http\Responses\Admin\Users;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class UserIndexResponse implements Responsable
{
    public function __construct(
        private readonly array $data = []
    ) {}

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse($this->data);
        }

        return view('livewire.admin.users.users-list', $this->data);
    }
}
