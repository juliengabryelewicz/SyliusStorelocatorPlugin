<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Admin\Storelocator;

use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Behaviour\ContainsEmptyListTrait;

class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    use ContainsEmptyListTrait;

    public function deleteStorelocator($name): void
    {
        $this->deleteResourceOnPage(['name' => $name]);
    }
}
