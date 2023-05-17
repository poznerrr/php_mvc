<?php
declare(strict_types=1);

namespace Source\Models\DTO;

use Source\Interfaces\Idto;

class NewsDto implements Idto
{
    public string $status = 'success';

    public function __construct(
        public int    $id,
        public string $title,
        public string $post,
        public string $category,
        public string $author,
        public string $date)
    {
    }


    public function toJson(): string
    {
        return json_encode([
                'answer' => $this->status,
                'id' => $this->id,
                'title' => $this->title,
                'post' => $this->post,
                'category' => $this->category,
                'author' => $this->author,
                'date' => $this->date
            ]
        );
    }
}
