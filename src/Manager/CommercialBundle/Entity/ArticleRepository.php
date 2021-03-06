<?php

namespace Manager\CommercialBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    
public function getArticleAvecranges($id)
{
    $entities = $em->createQuery('SELECT a, u, f FROM ManagerCommercialBundle:Article a JOIN a.ranges u JOIN u.articles f WHERE f.id = :id');
    $entities->setParameters(array('id' => $id));
}
    
}
