<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DealCompanyTypeRepository")
 */
class DealCompanyType
{
    const DISTRIBUTOR = 1;
    const OPTIME = 3;
    const MANUFACTURER = 4;
    const PLATINUM = 13;
    const SILVER = 14;
    const GOLD = 15;
    const HP_BUSINESS_PARTNER = 16;
    const RESELLER = 17;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="integer")
     */
    private $companyTypeGroup;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCompanyTypeGroup(): ?int
    {
        return $this->companyTypeGroup;
    }

    public function setCompanyTypeGroup(int $companyTypeGroup): self
    {
        $this->companyTypeGroup = $companyTypeGroup;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }


}
