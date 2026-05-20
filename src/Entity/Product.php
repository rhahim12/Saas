<?php

namespace App\Entity;

use App\Enum\ProductEnum;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price = null;

    #[ORM\Column(enumType: ProductEnum::class)]
    private ?ProductEnum $unit = null;

    /**
     * @var Collection<int, Invoiceitem>
     */
    #[ORM\OneToMany(targetEntity: Invoice::class, mappedBy: 'product')]
    private Collection $invoice;

    public function __construct()
    {
        $this->invoice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getUnit(): ?ProductEnum
    {
        return $this->unit;
    }

    public function setUnit(ProductEnum $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return Collection<int, Invoiceitem>
     */
    public function getInvoice(): Collection
    {
        return $this->invoice;
    }

    public function addInvoice(Invoiceitem $invoice): static
    {
        if (!$this->invoice->contains($invoice)) {
            $this->invoice->add($invoice);
            $invoice->setProduct($this);
        }

        return $this;
    }

    public function removeInvoice(Invoiceitem $invoice): static
    {
        if ($this->invoice->removeElement($invoice)) {
            // set the owning side to null (unless already changed)
            if ($invoice->getProduct() === $this) {
                $invoice->setProduct(null);
            }
        }

        return $this;
    }
}
