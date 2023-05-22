<?php

namespace Source\App;

use JetBrains\PhpStorm\NoReturn;

class DtoValidator
{
    public static function checkValidation(Request $request, string $dtoClass): bool
    {
        $reflector = new \ReflectionClass($dtoClass);
        $properties = $reflector->getProperties();
        foreach ($properties as $property) {
            $prop_Name = $property->getName() ?? null;
            $prop_Type = $property->getType() ?? null;
            //проверяю на наличие атрибуда в request
            if ($request->getParam($prop_Name) === null) {
                return false;
                //проверяю возможность каста для int параметра
            } elseif ($prop_Type == 'int' && !is_numeric($request->getParam($prop_Name))) {
                return false;
            }
        }
        return true;
    }
}