<?php

namespace App\Entity\Interface;

use App\Entity\Embeddable\Detail;

interface DetailInterface
{
    public function getDetail(): Detail;

    public function setDetail(Detail $detail): DetailInterface;
}