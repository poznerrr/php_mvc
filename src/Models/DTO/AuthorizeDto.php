<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\Interfaces\IJsonEncodable;

class AuthorizeDto implements IJsonEncodable
{
    public string $status = 'success';

    public function __construct(public string $jwt)
    {
    }


    public function toJson(): string
    {
        return json_encode([
                'answer' => $this->status,
                'jwt' => $this->jwt,
            ]
        );
    }
}
