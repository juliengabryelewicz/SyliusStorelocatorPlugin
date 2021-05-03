<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Behaviour;

interface ContainsErrorInterface
{
    public function containsErrorWithMessage(string $message, bool $strict = true): bool;
}
