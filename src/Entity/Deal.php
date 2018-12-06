<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DealRepository")
 */
class Deal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalUsd;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCloseToExpiredNotified;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DealInvoice", inversedBy="deals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dealInvoice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DealStatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dealStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalUsd(): ?int
    {
        return $this->totalUsd;
    }

    public function setTotalUsd(int $totalUsd): self
    {
        $this->totalUsd = $totalUsd;

        return $this;
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function setIsConfirmed(bool $isConfirmed): self
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getIsCloseToExpiredNotified(): ?bool
    {
        return $this->isCloseToExpiredNotified;
    }

    public function setIsCloseToExpiredNotified(bool $isCloseToExpiredNotified): self
    {
        $this->isCloseToExpiredNotified = $isCloseToExpiredNotified;

        return $this;
    }

    public function getDealInvoice(): ?DealInvoice
    {
        return $this->dealInvoice;
    }

    public function setDealInvoice(?DealInvoice $dealInvoice): self
    {
        $this->dealInvoice = $dealInvoice;

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
