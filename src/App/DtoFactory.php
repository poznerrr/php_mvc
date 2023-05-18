<?php
declare(strict_types=1);

namespace Source\App;

use Source\Interfaces\IAnswerDto;

class DtoFactory
{
    public static function fromRequest(Request $req) : IAnswerDto {
        $DtoFolder = Registry::get('DtoFolder');
        switch ($req) {
            case strtolower($req['controller']) === 'newsapi': {

            }
        }
        var_dump($req);
        die();
    }

}