<?php 

namespace App\Entity;
   

use Symfony\Component\Validator\Constraints as Assert;


class DateInfoEntity
{
    #[Assert\NotBlank]
    public \DateTime $yourDate;


    public function getYourDate(): \DateTime
    {
        return $this->yourDate;
    }

    public function setYourDate(\DateTime $yourDate): void 
    {
        $this->yourDate = $yourDate;
    }
}