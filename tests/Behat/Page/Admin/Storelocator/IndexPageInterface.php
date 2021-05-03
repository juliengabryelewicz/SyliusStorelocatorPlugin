<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Admin\Storelocator;

use Sylius\Behat\Page\Admin\Crud\IndexPageInterface as BaseIndexPageInterface;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Behaviour\ContainsEmptyListInterface;

interface IndexPageInterface extends BaseIndexPageInterface, ContainsEmptyListInterface
{
    public function deleteStorelocator(string $code): void;
}
