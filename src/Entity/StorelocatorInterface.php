<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Entity;

use Sylius\Component\Channel\Model\ChannelsAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Symfony\Component\HttpFoundation\File\File;

interface StorelocatorInterface extends
    ResourceInterface,
    TranslatableInterface,
    ToggleableInterface,
    ChannelsAwareInterface
{

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getAddress(): ?string;

    public function setAddress(?string $address): void;

    public function getEmail(): ?string;

    public function setEmail(?string $email): void;

    public function getPhone(): ?string;

    public function setPhone(?string $phone): void;

    public function setImageFile(?File $image): void;

    public function getImageFile(): ?File;

    public function getImageSource(): ?string;

    public function setImageSource(?string $imageSource): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;
}