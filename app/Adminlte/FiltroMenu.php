<?php

namespace App\Adminlte;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class FiltroMenu implements FilterInterface
{
    public function transform($item)
    {
        if ($item['admin'] == true && auth()->user()->admin == false) {
            return null;
        }

        return $item;
    }
}