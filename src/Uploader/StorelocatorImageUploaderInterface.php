<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Uploader;

use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;

interface StorelocatorImageUploaderInterface
{
    public function upload(StorelocatorInterface $storelocator): void;

    public function remove(string $path): bool;
}
