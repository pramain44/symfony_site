<?php

namespace App\TwigExtensions;

use Twig\Extension\AbsctractExtension;
use Twig\TwigFilter;

class customExtensions extends AbsctractExtension{

    public function getFilters(){
        return [
            new TwigFilter ('name', [$this, 'functionName'])
        ];
    }

    // la fonction prend en paramtere la valeurs qu'on veut "pipe" ie filtrer
    public function functionName(string $path): string{
    // ds ce cas ci on veut retourner une image par defauts s'il n'y a pas d'image (c'est ce que fait le filtre)
        if(strlen(trim($path)) == 0){
            return 'as.jpg';
        }
        return $path;
    }
}
