<?php

namespace App\Entity\Trait;

use App\Entity\Embeddable\Detail;
use App\Entity\Interface\DetailInterface;
use Doctrine\ORM\Mapping as ORM;

trait DetailTrait
{
    #[ORM\Embedded(class: Detail::class, columnPrefix: false)]
    protected Detail $detail;

    public function __construct(){
        $this->detail = new Detail();
    }

    public function getDetail(): Detail
    {
        return $this->detail;
    }

    public function setDetail(Detail $detail): DetailInterface
    {
        $this->detail = $detail;

        return $this;
    }

}