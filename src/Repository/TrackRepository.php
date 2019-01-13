<?php

namespace App\Repository;

use App\Entity\Track;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Track|null find($id, $lockMode = null, $lockVersion = null)
 * @method Track|null findOneBy(array $criteria, array $orderBy = null)
 * @method Track[]    findAll()
 * @method Track[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry, EntityManagerInterface $em)
    {
        parent::__construct($registry, Track::class);
        $this->_em = $em;
    }

    public function save(Track $track)
    {
        $this->_em->persist($track);
        $this->_em->flush();
    }

    public function fetchAvailableTracks($limit = 10)
    {
        $tracks = $this->createQueryBuilder('s')
            ->select('partial s.{id, name, artist, url}')
            ->getQuery()
            ->getArrayResult()
        ;

        $processedTracks = [];

        // this seems hacky
        foreach ($tracks as $track) {
            $tempTrack = new Track();
            $tempTrack->setUrl($track['url']);
            $track['ytid'] = $tempTrack->getYTID();
            $processedTracks[] = $track;
        }

        return $processedTracks;
    }
    // /**
    //  * @return Track[] Returns an array of Track objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Track
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
