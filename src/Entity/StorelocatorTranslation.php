<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Entity;

use Sylius\Component\Resource\Model\AbstractTranslation;

class StorelocatorTranslation extends AbstractTranslation implements StorelocatorTranslationInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $description;

    /** @var string */
    protected $hours;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(string $hours): void
    {
        $this->hours = $hours;
    }

}
