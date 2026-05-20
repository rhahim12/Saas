<?php

namespace App\Entity;

use App\Enum\InvoiceEnum;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column]
    private ?float $total_ttc = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(enumType: InvoiceEnum::class)]
    private ?InvoiceEnum $status = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'invoice')]
    private Collection $user;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'invoice')]
    private Collection $client;

    #[ORM\ManyToOne(inversedBy: 'invoice')]
    private ?InvoiceItem $invoiceItem = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getTotalTtc(): ?float
    {
        return $this->total_ttc;
    }

    public function setTotalTtc(float $total_ttc): static
    {
        $this->total_ttc = $total_ttc;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatus(): ?InvoiceEnum
    {
        return $this->status;
    }

    public function setStatus(InvoiceEnum $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(user $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setInvoice($this);
        }

        return $this;
    }

    public function removeUser(user $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getInvoice() === $this) {
                $user->setInvoice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, client>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(client $client): static
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setInvoice($this);
        }

        return $this;
    }

    public function removeClient(client $client): static
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getInvoice() === $this) {
                $client->setInvoice(null);
            }
        }

        return $this;
    }

    public function getInvoiceItem(): ?InvoiceItem
    {
        return $this->invoiceItem;
    }

    public function setInvoiceItem(?InvoiceItem $invoiceItem): static
    {
        $this->invoiceItem = $invoiceItem;

        return $this;
    }
}
