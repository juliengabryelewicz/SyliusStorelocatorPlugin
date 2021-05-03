<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Service;

interface StringGeneratorInterface
{
    public function generate(int $length = 20): string;
}
