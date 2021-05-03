<?php

declare(strict_types=1);

namespace spec\Jgabryelewicz\SyliusStorelocatorPlugin\Entity;

use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\Storelocator;
use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

final class StorelocatorSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(Storelocator::class);
    }

    function it_is_a_resource(): void
    {
        $this->shouldHaveType(ResourceInterface::class);
    }

    function it_implements_storelocator_interface(): void
    {
        $this->shouldHaveType(StorelocatorInterface::class);
    }

    function it_allows_access_via_properties(): void
    {
        $this->setEnabled(true);
        $this->isEnabled()->shouldReturn(true);
    }

    function it_toggles(): void
    {
        $this->enable();
        $this->isEnabled()->shouldReturn(true);
        $this->disable();
        $this->isEnabled()->shouldReturn(false);
    }

    function it_associates_channels(ChannelInterface $firstChannel, ChannelInterface $secondChannel): void
    {
        $this->addChannel($firstChannel);
        $this->hasChannel($firstChannel)->shouldReturn(true);
        $this->hasChannel($secondChannel)->shouldReturn(false);
        $this->removeChannel($firstChannel);
        $this->hasChannel($firstChannel)->shouldReturn(false);
    }
}
