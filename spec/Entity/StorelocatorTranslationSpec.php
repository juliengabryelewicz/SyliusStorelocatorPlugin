<?php

declare(strict_types=1);

namespace spec\Jgabryelewicz\SyliusStorelocatorPlugin\Entity;

use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorTranslation;
use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorTranslationInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

final class StorelocatorTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StorelocatorTranslation::class);
    }

    function it_is_a_resource()
    {
        $this->shouldHaveType(ResourceInterface::class);
    }

    function it_implements_storelocator_translation_interface()
    {
        $this->shouldHaveType(StorelocatorTranslationInterface::class);
        $this->shouldHaveType(TranslationInterface::class);
    }

    function it_allows_access_via_properties()
    {
        $this->setDescription('Bonne pioche is a game shop in north of France');
        $this->getDescription()->shouldReturn('Bonne pioche is a game shop in north of France');
        $this->setHours('Everyday from 9am to 5pm');
        $this->getHours()->shouldReturn('Everyday from 9am to 5pm');
    }
}
