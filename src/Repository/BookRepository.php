<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findPublishedBook()
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.author', 'a')
            ->where('a.username = :username')
            ->andWhere('b.published = :published')
            ->setParameters([
                'published'=>1,
                'username' => 'saraj'
            ])
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult();

    }
    public function findBookByDate()
    {
        return $this->createQueryBuilder('b')
            ->where('b.pubdate > :pubdate')
            ->setParameters([
                'pubdate' => '2023-01-01'
            ])
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findBookbyref($ref)
    {
        return $this->createQueryBuilder('b')
            ->where('b.ref = :ref')
            ->setParameter('ref', $ref)
            ->getQuery()
            ->getResult();

    }

    public function booksListByAuthors($name)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.author', 'a')
            ->where('a.username = :username')
            ->setParameters([
                'username' => $name ,
            ])
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function modifyBooksCategory()
    {
        return $this->createQueryBuilder('b')
            ->where('b.category = :category')
            ->setParameters([
                'category' => 'Romance',
            ])
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}