<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Repository;

use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface StorelocatorRepositoryInterface extends RepositoryInterface
{
    public function createListQueryBuilder(string $localeCode): QueryBuilder;

    public function findEnabledByChannel(string $localeCode, string $channelCode): array;

}
