<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Page\Shop\Storelocator;

use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;

final class IndexPage extends SymfonyPage implements IndexPageInterface
{
    public function getRouteName(): string
    {
        return 'jgabryelewicz_sylius_storelocator_plugin_shop_storelocator_index';
    }

    public function hasStorelocatorsNumber(int $number): bool
    {
        $storelocatorsOnPage = $this->getElement('storelocators')->findAll('css', '.storelocator');

        return $number === count($storelocatorsOnPage);
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'storelocators' => '#storelocators-list',
        ]);
    }

}
