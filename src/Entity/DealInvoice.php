<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DealInvoiceRepository")
 * @Vich\Uploadable
 */
class DealInvoice
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
    private $invoiceNumber;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $correlative;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $purchaseInvoiceDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $computo;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $computoWinPro;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalUnits;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalQuantity;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="file_invoice", fileNameProperty="fileName")
     *
     * @var File
     */
    private $fileInvoice;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $fileName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BusinessUnit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $businessUnit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DealCompany", inversedBy="dealInvoices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dealCompany;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Deal", mappedBy="dealInvoice")
     */
    private $deals;

    public function __construct()
    {
        $this->deals = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getCorrelative(): ?string
    {
        return $this->correlative;
    }

    public function setCorrelative(?string $correlative): self
    {
        $this->correlative = $correlative;

        return $this;
    }

    public function getPurchaseInvoiceDate(): ?\DateTimeInterface
    {
        return $this->purchaseInvoiceDate;
    }

    public function setPurchaseInvoiceDate(?\DateTimeInterface $purchaseInvoiceDate): self
    {
        $this->purchaseInvoiceDate = $purchaseInvoiceDate;

        return $this;
    }

    public function getComputo(): ?string
    {
        return $this->computo;
    }

    public function setComputo(?string $computo): self
    {
        $this->computo = $computo;

        return $this;
    }

    public function getComputoWinPro(): ?string
    {
        return $this->computoWinPro;
    }

    public function setComputoWinPro(?string $computoWinPro): self
    {
        $this->computoWinPro = $computoWinPro;

        return $this;
    }

    public function getTotalUnits(): ?int
    {
        return $this->totalUnits;
    }

    public function setTotalUnits(int $totalUnits): self
    {
        $this->totalUnits = $totalUnits;

        return $this;
    }

    public function getTotalQuantity(): ?int
    {
        return $this->totalQuantity;
    }

    public function setTotalQuantity(?int $totalQuantity): self
    {
        $this->totalQuantity = $totalQuantity;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $fileInvoice
     */
    public function setFileInvoice(?File $fileInvoice = null): void
    {
        $this->fileInvoice = $fileInvoice;
    }

    public function getFileInvoice(): ?File
    {
        return $this->fileInvoice;
    }

    public function setFileName(?string $fileName): void
    {
        $this->fileName = $fileName;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function getBusinessUnit(): ?BusinessUnit
    {
        return $this->businessUnit;
    }

    public function setBusinessUnit(?BusinessUnit $businessUnit): self
    {
        $this->businessUnit = $businessUnit;

        return $this;
    }

    public function getDealCompany(): ?DealCompany
    {
        return $this->dealCompany;
    }

    public function setDealCompany(?DealCompany $dealCompany): self
    {
        $this->dealCompany = $dealCompany;

        return $this;
    }

    /**
     * @return Collection|Deal[]
     */
    public function getDeals(): Collection
    {
        return $this->deals;
    }

    public function addDeal(Deal $deal): self
    {
        if (!$this->deals->contains($deal)) {
            $this->deals[] = $deal;
            $deal->setDealInvoice($this);
        }

        return $this;
    }

    public function removeDeal(Deal $deal): self
    {
        if ($this->deals->contains($deal)) {
            $this->deals->removeElement($deal);
            // set the owning side to null (unless already changed)
            if ($deal->getDealInvoice() === $this) {
                $deal->setDealInvoice(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getInvoiceNumber();
    }


}
