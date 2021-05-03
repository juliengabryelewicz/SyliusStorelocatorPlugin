<?php

declare(strict_types=1);

namespace Jgabryelewicz\SyliusStorelocatorPlugin\Repository;

use Jgabryelewicz\SyliusStorelocatorPlugin\Entity\StorelocatorInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class StorelocatorRepository extends EntityRepository implements StorelocatorRepositoryInterface
{
    public function createListQueryBuilder(string $localeCode): QueryBuilder
    {
        return $this->createQueryBuilder('s')
            ->addSelect('translation')
            ->leftJoin('s.translations', 'translation', 'WITH', 'translation.locale = :localeCode')
            ->setParameter('localeCode', $localeCode)
        ;
    }

    public function findEnabledByChannel(string $localeCode, string $channelCode): array
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.translations', 'translation')
            ->innerJoin('s.channels', 'channels')
            ->where('translation.locale = :localeCode')
            ->andWhere('s.enabled = true')
            ->andWhere('channels.code = :channelCode')
            ->setParameter('localeCode', $localeCode)
            ->setParameter('channelCode', $channelCode)
            ->getQuery()
            ->getResult()
        ;
    }

}
