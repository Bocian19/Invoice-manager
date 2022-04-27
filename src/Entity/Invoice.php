<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $number;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Client")
     * @JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\Column(type="float")
     */
    private $product_total_net_price;

    /**
     * @ORM\Column(type="float")
     */
    private $invoice_total_net_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct($product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProductTotalNetPrice(): ?float
    {
        return $this->product_total_net_price;
    }

    public function setProductTotalNetPrice(float $product_total_net_price): self
    {
        $this->product_total_net_price = $product_total_net_price;

        return $this;
    }

    public function getInvoiceTotalNetPrice(): ?float
    {
        return $this->invoice_total_net_price;
    }

    public function setInvoiceTotalNetPrice(float $invoice_total_net_price): self
    {
        $this->invoice_total_net_price = $invoice_total_net_price;

        return $this;
    }
}
