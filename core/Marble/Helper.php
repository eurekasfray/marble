<?php

namespace Marble;

class Helper
{

    public static function normalizePath($path)
    {
        $path = trim($path);
        $path = trim($path,'/');
        return $path;
    }

}
