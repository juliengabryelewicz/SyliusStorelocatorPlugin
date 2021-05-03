<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\EventListener;

use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;
use Jgabryelewicz\SyliusStorelocatorPlugin\Uploader\StorelocatorImageUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class StorelocatorImageUploadListener
{
    private $uploader;

    public function __construct(StorelocatorImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadImage(GenericEvent $event): void
    {
        $storelocator = $event->getSubject();
        Assert::isInstanceOf($storelocator, StorelocatorInterface::class);

        $this->uploader->upload($storelocator);
    }
}
