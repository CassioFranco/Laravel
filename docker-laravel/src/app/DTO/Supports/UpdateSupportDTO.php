<?php

namespace App\DTO\Supports;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupport;

class UpdateSupportDTO{

    public function __construct(
        public $id,
        public string $subject,
        public SupportStatus $status,
        public string $body

        ){

    }

    public static function MakeFromRequest(StoreUpdateSupport $request): self{
        return new self (
            $request->id,
            $request->subject,
            SupportStatus::A,
            $request->body
        );
    }
}
