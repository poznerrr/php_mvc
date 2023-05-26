<?php
declare(strict_types=1);

namespace Source\App;

use Source\Models\{Post, TSingletone};
use Source\Interfaces\IInstanceble;

class UriMaker implements IInstanceble
{
    use TSingletone;

    private array $ruEnConverter = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
    ];

    public function urlRuEnTranslite(string $ruString): string
    {
        $enString = mb_ereg_replace('[\W]+', '-', $ruString);
        $enString = mb_ereg_replace('[-]+', '-', $enString);
        $enString = trim($enString, '-');
        return strtr(mb_strtolower($enString), $this->ruEnConverter);
    }

    public function makeTitleUri(Post $post): string
    {
        return "/news/chosen/" . $this->urlRuEnTranslite($post->getTitle()) . '-r' . $post->getId();
    }

}