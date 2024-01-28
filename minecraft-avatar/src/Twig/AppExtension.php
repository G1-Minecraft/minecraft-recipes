<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('md5', [$this, 'md5Filter']),
        ];
    }

    public function md5Filter($value)
    {
        return md5($value);
    }
}
