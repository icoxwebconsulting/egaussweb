<?php

namespace BackendBundle\Repository;
use Doctrine\ORM\QueryBuilder;

/**
 * NoticiaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoticiaRepository extends \Doctrine\ORM\EntityRepository
{

    public function findNoticiasLimit($limit){
        $em = $this->getEntityManager();
        $qb = new QueryBuilder($em);
        $qb->add('select', 'u')
            ->add('from', 'BackendBundle:Noticia u')
            ->add('orderBy', 'u.fecha DESC')
            ->setFirstResult( 0 )
            ->setMaxResults( $limit );
        $query = $qb->getQuery();
        return $query->getResult();
    }
    public function findNoticiasGlobalLimit($limit){
        $em = $this->getEntityManager();
        $qb = new QueryBuilder($em);
        $qb->add('select', 'u')
            ->add('from', 'BackendBundle:Noticia u')
            ->where("u.owner = 'global-imast'")
            ->add('orderBy', 'u.fecha DESC')
            ->setFirstResult( 0 )
            ->setMaxResults( $limit );
        $query = $qb->getQuery();
        return $query->getResult();



    }
}
