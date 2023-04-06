<?php

namespace App\Dto;

class CounterDTO
{
    public function __construct(public string $title, public string $entity, public string $url = '#'){

    }
}