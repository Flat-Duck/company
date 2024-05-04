<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Helper
{
    public static function MakeNumber($model)
    {
        $code = $model::CODE;
        $number = $model::getNewCode();
        return  $code."-".now()->year."-".$number;
    }
}