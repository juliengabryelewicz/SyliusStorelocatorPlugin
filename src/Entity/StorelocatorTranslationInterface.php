<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface StorelocatorTranslationInterface extends TranslationInterface, ResourceInterface
{
    public function getDescription(): ?string;

    public function setDescription(string $description): void;

    public function getHours(): ?string;

    public function setHours(string $hours): void;

}
