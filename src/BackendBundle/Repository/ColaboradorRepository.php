<?php

namespace BackendBundle\Repository;
use Doctrine\ORM\QueryBuilder;

/**
 * ColaboradorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ColaboradorRepository extends \Doctrine\ORM\EntityRepository
{

    public function findColaboradoresLimit($limit){
        $em = $this->getEntityManager();
        $qb = new QueryBuilder($em);
        $qb->add('select', 'u')
            ->add('from', 'BackendBundle:Colaborador u')
            ->setFirstResult( 0 )
            ->setMaxResults( $limit );
        $query = $qb->getQuery();
        return $query->getResult();

    }
}
