<?php

namespace App\Modules\Identity\Http\Responses\Admin\Dashboard;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class DashboardResponse implements Responsable
{
    public function __construct(
        private readonly array $data = []
    ) {}

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return new JsonResponse($this->data);
        }

        return view('livewire.admin.dashboard', $this->data);
    }
}
