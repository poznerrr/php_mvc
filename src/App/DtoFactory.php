<?php
declare(strict_types=1);

namespace Source\App;

use Source\Interfaces\Idto;

class DtoFactory
{
    public static function fromRequest(Request $req) : Idto {
        $DtoFolder = Registry::get('DtoFolder');
        switch ($req) {
            case strtolower($req['controller']) === 'newsapi': {

            }
        }
        var_dump($req);
        die();
    }

}