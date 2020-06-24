<?php

declare(strict_types=1);

namespace App\BasicRum\Visit\Data;

use App\Entity\RumDataFlat;
use App\Entity\VisitsOverview;

class Fetch
{
    /** @var \Doctrine\Bundle\DoctrineBundle\Registry */
    private $registry;

    /** @var Filter */
    private $filter;

    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $registry)
    {
        $this->registry = $registry;
        $this->filter = new Filter($registry);
    }

    /**
     * @return mixed
     */
    public function fetchNavTimingsInRange(int $startId, int $endId): array
    {
        $repository = $this->registry
            ->getRepository(RumDataFlat::class);

        $query = $repository->createQueryBuilder('nt')
            ->where("nt.pageViewId >= '".$startId."' AND nt.pageViewId <= '".$endId."'")
            ->andWhere('nt.deviceTypeId != :deviceTypeId')
            ->setParameter('deviceTypeId', $this->filter->getBotDeviceTypeId())
            ->select(['nt.rt_si', 'nt.createdAt', 'nt.pageViewId', 'nt.urlId'])
            ->orderBy('nt.pageViewId', 'DESC')
            ->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    /**
     * @return mixed
     */
    public function fetchNavTimingsInRangeForSession(int $startId, int $endId, string $rt_si): array
    {
        $repository = $this->registry
            ->getRepository(RumDataFlat::class);

        $query = $repository->createQueryBuilder('nt')
            ->where("nt.pageViewId >= '".$startId."' AND nt.pageViewId <= '".$endId."'")
            ->andWhere('nt.deviceTypeId != :deviceTypeId')
            ->andWhere('nt.rt_si = :rt_si')
            ->setParameter('deviceTypeId', $this->filter->getBotDeviceTypeId())
            ->setParameter('rt_si', $rt_si)
            ->select(['nt.rt_si', 'nt.createdAt', 'nt.pageViewId', 'nt.urlId'])
            ->getQuery();

        return $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function fetchNotCompletedVisits(): array
    {
        $repository = $this->registry
            ->getRepository(VisitsOverview::class);

        $query = $repository->createQueryBuilder('vo')
            ->where('vo.completed = 0')
            ->select(['vo'])
            ->getQuery();

        $visits = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        $transformed = [];

        foreach ($visits as $visit) {
            $transformed[$visit['firstPageViewId']] = $visit;
        }

        return $transformed;
    }

    public function fetchPreviousLastScannedPageViewId(): int
    {
        $repository = $this->registry
            ->getRepository(VisitsOverview::class);

        $pageViewId = (int) $repository->createQueryBuilder('vo')
            ->select('MAX(vo.lastPageViewId)')
            ->getQuery()
            ->getSingleScalarResult();

        return $pageViewId;
    }

    public function fetchPreviousSessionPageView(array $pageView): array
    {
        $repository = $this->registry
            ->getRepository(RumDataFlat::class);

        $pageViewId = $pageView['pageViewId'];
        $rt_si = $pageView['rt_si'];

        $query = $repository->createQueryBuilder('nt')
            ->where("nt.pageViewId < '".$pageViewId."'")
            ->andWhere('nt.rt_si = :rt_si')
            ->setParameter('rt_si', $rt_si)
            ->select(['nt.createdAt', 'nt.pageViewId', 'nt.rt_si'])
            ->orderBy('nt.pageViewId', 'DESC')
            ->setMaxResults(1)
            ->getQuery();

        $res = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);

        return $res[0] ?? [];
    }
}
