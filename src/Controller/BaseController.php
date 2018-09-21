<?php

namespace App\Controller;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class BaseController
 * @package App\Controller
 */
abstract class BaseController extends AbstractController
{
    /**
     * @var Entity
     */
    protected static $entityClass;

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }
    
    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository(static::$entityClass);
    }

    /**
     * @param $id
     * @return null|object
     */
    public function find(int $id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function findAllBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }
    
    /**
     * @param string $q
     * @param array $fields
     * @return mixed
     */
    public function findAllByLike(?string $q, array $fields)
    {
        return $this->getRepository()->findAllByLike($q, $fields);
    }
}
