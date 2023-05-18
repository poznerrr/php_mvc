<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\Interfaces\IAnswerDto;

class SuccessDto implements IAnswerDto
{
    public string $status = 'success';

    public function __construct(public string $message)
    {
    }

    public function toJson(): string
    {
        return json_encode(['answer' => $this->status, 'message' => $this->message]);
    }
}