<?php

declare(strict_types=1);

namespace spec\Jgabryelewicz\SyliusStorelocatorPlugin\Menu;

use Jgabryelewicz\SyliusStorelocatorPlugin\Menu\StorelocatorMenuBuilder;
use Knp\Menu\ItemInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class StorelocatorBuilderSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(StorelocatorMenuBuilder::class);
    }

    function it_build_menu(
        MenuBuilderEvent $menuBuilderEvent,
        ItemInterface $menu,
        ItemInterface $storelocatorRootMenuItem
    ): void {
        $menuBuilderEvent->getMenu()->willReturn($menu);
        $menu->addChild('jgabryelewicz_storelocator')->willReturn($storelocatorRootMenuItem);

        $storelocatorRootMenuItem
            ->addChild('storelocator', ['route' => 'jgabryelewicz_sylius_storelocator_plugin_admin_storelocator_index'])
            ->willReturn($storelocatorRootMenuItem)
        ;
        $storelocatorRootMenuItem->setLabel('jgabryelewicz_sylius_storelocator_plugin.ui.storelocator')->willReturn($storelocatorRootMenuItem);
        $storelocatorRootMenuItem->setLabelAttribute('icon', 'help')->shouldBeCalled();

        $this->buildMenu($menuBuilderEvent);
    }
}
