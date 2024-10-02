<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO{

    public function __construct(public string $subject,public string $status,public string $body ){



    }

    public static function MakeFromRequest(StoreUpdateSupport $request): self{
        return new self (
            $request->subject,
            'A',
            $request->body
        );
    }
}
