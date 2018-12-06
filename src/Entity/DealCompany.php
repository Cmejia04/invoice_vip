<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DealCompanyRepository")
 */
class DealCompany
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $webSite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DealCompanyType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dealCompanyType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DealInvoice", mappedBy="dealCompany")
     */
    private $dealInvoices;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DealStatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dealStatus;

    public function __construct()
    {
        $this->dealInvoices = new ArrayCollection();
    }

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(?string $webSite): self
    {
        $this->webSite = $webSite;

        return $this;
    }

    public function getDealCompanyType(): ?DealCompanyType
    {
        return $this->dealCompanyType;
    }

    public function setDealCompanyType(?DealCompanyType $dealCompanyType): self
    {
        $this->dealCompanyType = $dealCompanyType;

        return $this;
    }

    /**
     * @return Collection|DealInvoice[]
     */
    public function getDealInvoices(): Collection
    {
        return $this->dealInvoices;
    }

    public function addDealInvoice(DealInvoice $dealInvoice): self
    {
        if (!$this->dealInvoices->contains($dealInvoice)) {
            $this->dealInvoices[] = $dealInvoice;
            $dealInvoice->setDealCompany($this);
        }

        return $this;
    }

    public function removeDealInvoice(DealInvoice $dealInvoice): self
    {
        if ($this->dealInvoices->contains($dealInvoice)) {
            $this->dealInvoices->removeElement($dealInvoice);
            // set the owning side to null (unless already changed)
            if ($dealInvoice->getDealCompany() === $this) {
                $dealInvoice->setDealCompany(null);
            }
        }

        return $this;
    }

    public function getDealStatus(): ?DealStatus
    {
        return $this->dealStatus;
    }

    public function setDealStatus(?DealStatus $dealStatus): self
    {
        $this->dealStatus = $dealStatus;

        return $this;
    }
}
