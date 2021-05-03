<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class StorelocatorMenuBuilder
{
    public function buildMenu(MenuBuilderEvent $menuBuilderEvent): void
    {
        $menu = $menuBuilderEvent->getMenu();

        $storelocatorRootMenuItem = $menu
            ->addChild('jgabryelewicz_storelocator')
            ->setLabel('jgabryelewicz_sylius_storelocator_plugin.ui.storelocator')
        ;

        $storelocatorRootMenuItem
            ->addChild('storelocator', [
                'route' => 'jgabryelewicz_sylius_storelocator_plugin_admin_storelocator_index',
            ])
            ->setLabel('jgabryelewicz_sylius_storelocator_plugin.ui.storelocator')
            ->setLabelAttribute('icon', 'sticky note')
        ;
    }
}
