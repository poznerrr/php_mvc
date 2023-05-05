<?php
declare(strict_types=1);

namespace Source\App;

use Source\Models\{Post,TSingletone};
class UriMaker
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
        $enString = str_replace([' ', ',', '.', '–', '«', '»', ':', '?', '!','+',chr(38),"quot;",'/','\\'], '-', $ruString);
        $enString = mb_ereg_replace('[-]+', '-', $enString);
        $enString = trim($enString, '-');
        $enString = strtr(mb_strtolower($enString), $this->ruEnConverter);
        return $enString;
    }

    public function makeTitleUri(Post $post): string
    {
        return "/news/".$this->urlRuEnTranslite($post->getTitle()) . '-r' . $post->getId();
    }

}