<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Uploader;

use Gaufrette\FilesystemInterface;
use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;
use Symfony\Component\HttpFoundation\File\File;
use Webmozart\Assert\Assert;

final class StorelocatorImageUploader implements StorelocatorImageUploaderInterface
{
    private $filesystem;

    public function __construct(
        FilesystemInterface $filesystem
    ) {
        $this->filesystem = $filesystem;
    }

    public function upload(StorelocatorInterface $storelocator): void
    {
        if ($storelocator->getImageFile() === null) {
            return;
        }

        $file = $storelocator->getImageFile();

        if (null !== $storelocator->getImageSource() && $this->has($storelocator->getImageSource())) {
            $this->remove($storelocator->getImageSource());
        }

        do {
            $path = $this->name($file);
        } while ($this->filesystem->has($path));

        $storelocator->setImageSource($path);

        if ($storelocator->getImageSource() === null) {
            return;
        }

        if (file_get_contents($file->getPathname()) === false) {
            return;
        }

        $this->filesystem->write(
            $storelocator->getImageSource(),
            file_get_contents($file->getPathname()),
            true
        );
    }

    public function remove(string $path): bool
    {
        if ($this->filesystem->has($path)) {
            return $this->filesystem->delete($path);
        }

        return false;
    }

    private function has(string $path): bool
    {
        return $this->filesystem->has($path);
    }

    private function name(File $file): string
    {
        $name = \str_replace('.', '', \uniqid('', true));
        $extension = $file->guessExtension();

        if (\is_string($extension) && '' !== $extension) {
            $name = \sprintf('%s.%s', $name, $extension);
        }

        return $name;
    }
}
