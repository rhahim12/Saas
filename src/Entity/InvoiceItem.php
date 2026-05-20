<?php

namespace App\Entity;

use App\Repository\InvoiceItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceItemRepository::class)]
class InvoiceItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    /**
     * @var Collection<int, invoice>
     */
    #[ORM\OneToMany(targetEntity: invoice::class, mappedBy: 'invoiceItem')]
    private Collection $invoice;

    #[ORM\ManyToOne(inversedBy: 'invoice')]
    private ?Product $product = null;

    public function __construct()
    {
        $this->invoice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, invoice>
     */
    public function getInvoice(): Collection
    {
        return $this->invoice;
    }

    public function addInvoice(invoice $invoice): static
    {
        if (!$this->invoice->contains($invoice)) {
            $this->invoice->add($invoice);
            $invoice->setInvoiceItem($this);
        }

        return $this;
    }

    public function removeInvoice(invoice $invoice): static
    {
        if ($this->invoice->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getInvoiceItem() === $this) {
                $invoice->setInvoiceItem(null);
            }
        }

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}
