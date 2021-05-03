<?php

declare(strict_types=1);

namespace Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Context\Setup;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;
use Jgabryelewicz\SyliusStorelocatorPlugin\Repository\StorelocatorRepositoryInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Tests\Jgabryelewicz\SyliusStorelocatorPlugin\Behat\Service\StringGeneratorInterface;

final class StorelocatorContext implements Context
{

    /** @var SharedStorageInterface */
    private $sharedStorage;

    /** @var StringGeneratorInterface */
    private $stringGenerator;

    /** @var FactoryInterface */
    private $storelocatorFactory;

    public function __construct(
        SharedStorageInterface $sharedStorage,
        StringGeneratorInterface $stringGenerator,
        FactoryInterface $storelocatorFactory,
        StorelocatorRepositoryInterface $storelocatorRepository
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->stringGenerator = $stringGenerator;
        $this->storelocatorFactory = $storelocatorFactory;
        $this->storelocatorRepository = $storelocatorRepository;
    }

    /** @var StorelocatorRepositoryInterface */
    private $storelocatorRepository;


    /**
     * @Given the store has a storelocator
     */
    public function theStoreHasAStorelocator()
    {
        $storelocator = $this->createStorelocator(null);
        $this->saveStorelocator($storelocator);
    }

    /**
     * @Given there are :number Storelocators in the store
     */
    public function thereAreStorelocatorsInTheStore(int $number)
    {
        for ($i = 1; $i <= $number; ++$i) {
            $storelocator = $this->createStorelocator(null);

            $this->saveStorelocator($storelocator);
        }
    }

    /**
     * @Given there is an existing storelocator with :name name
     */
    public function thereIsAnExistingStorelocatorWithName(string $name)
    {
        $storelocator = $this->createStorelocator($name);
        $this->saveStorelocator($storelocator);
    }

    /**
     * @param string|null $name
     * @param ChannelInterface $channel
     *
     * @return StorelocatorInterface
     */
    private function createStorelocator(
        ?string $name = null,
        ChannelInterface $channel = null
    ): StorelocatorInterface {
        /** @var StorelocatorInterface $storelocator */
        $storelocator = $this->storelocatorFactory->createNew();

        if (null === $channel && $this->sharedStorage->has('channel')) {
            $channel = $this->sharedStorage->get('channel');
        }

        if (null === $name) {
            $name = $this->stringGenerator->generate();
        }
        $address = $this->stringGenerator->generate();
        $email = "julien.gabryelewicz2@gmail.com";
        $phone = "0123456789";
        $description = $this->stringGenerator->generate();
        $hours = $this->stringGenerator->generate();

        $storelocator->setName($name);
        $storelocator->setAddress($address);
        $storelocator->setEmail($email);
        $storelocator->setPhone($phone);
        $storelocator->setCurrentLocale('en_US');
        $storelocator->setDescription($description);
        $storelocator->setHours($hours);
        $storelocator->addChannel($channel);

        return $storelocator;
    }

    private function saveStorelocator(StorelocatorInterface $storelocator): void
    {
        $this->storelocatorRepository->add($storelocator);
        $this->sharedStorage->set('storelocator', $storelocator);
    }

}
