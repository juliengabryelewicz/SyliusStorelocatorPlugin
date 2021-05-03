<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\HttpFoundation\File\File;

class Storelocator implements StorelocatorInterface
{
    use ToggleableTrait,
        TranslatableTrait {
        __construct as private initializeTranslationsCollection;
    }

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string|null */
    protected $address;

    /** @var string|null */
    protected $phone;

    /** @var string|null */
    protected $email;

    /** @var File|null */
    protected $imageFile;

    /** @var string|null */
    protected $imageSource;

    /** @var Collection|ChannelInterface[] */
    protected $channels;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->initializeChannelsCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageSource(?string $imageSource): void
    {
        $this->imageSource = $imageSource;
    }

    public function getImageSource(): ?string
    {
        return $this->imageSource;
    }

    public function getDescription(): ?string
    {
        return $this->getStorelocatorTranslation()->getDescription();
    }

    public function setDescription(?string $description): void
    {
        $this->getStorelocatorTranslation()->setDescription($description);
    }

    public function getHours(): ?string
    {
        return $this->getStorelocatorTranslation()->getHours();
    }

    public function setHours(?string $hours): void
    {
        $this->getStorelocatorTranslation()->setHours($hours);
    }

    public function initializeChannelsCollection(): void
    {
        $this->channels = new ArrayCollection();
    }

    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }

    /**
     * @return TranslationInterface|StorelocatorTranslationInterface
     */
    protected function getStorelocatorTranslation(): TranslationInterface
    {
        return $this->getTranslation();
    }

    protected function createTranslation(): TranslationInterface
    {
        return new StorelocatorTranslation();
    }
}
