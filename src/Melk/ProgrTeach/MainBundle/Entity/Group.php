<?php

namespace Melk\ProgrTeach\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\Group as BaseGroup;

/**
 * Group
 */
class Group extends BaseGroup
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Melk\ProgrTeach\MainBundle\Entity\Permission
     */
    private $permission;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set permission
     *
     * @param \Melk\ProgrTeach\MainBundle\Entity\Permission $permission
     * @return Group
     */
    public function setPermission(\Melk\ProgrTeach\MainBundle\Entity\Permission $permission = null)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return \Melk\ProgrTeach\MainBundle\Entity\Permission 
     */
    public function getPermission()
    {
        return $this->permission;
    }
}
