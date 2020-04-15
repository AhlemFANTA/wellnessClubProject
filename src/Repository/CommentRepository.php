<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @param article_id
     * @return Comment[]
     */
    public function findAllFromArticle($article_id): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT comment
        FROM App\Entity\Comment comment
        WHERE comment.article_id = :article_id'
        )->setParameter('article_id', $article_id);
        return $query->getResult();
    }

    public function findAllActiveFromArticle(int $article_id): array
    {
        $entityManager = $this->getEntityManager();
        $qb = $this->createQueryBuilder('p')
            ->where('p.article_id = :article_id')
            ->andWhere('p.is_visible = 1')
            ->setParameter('article_id', $article_id);
        $query = $qb->getQuery();
        return $query->execute();
    }

    public function findAllSubcomments(int $comment_id): array
    {
        $entityManager = $this->getEntityManager();
        $qb = $this->createQueryBuilder('p')
            ->where('p.parent_id = :comment_id')
            ->setParameter('comment_id', $comment_id);
        $query = $qb->getQuery();
        return $query->getResult();
    }
}
