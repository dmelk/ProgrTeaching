<?php

namespace Melk\ProgrTeach\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentCourse
 */
class StudentCourse
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return StudentCourse
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add groups
     *
     * @param \Melk\ProgrTeach\MainBundle\Entity\StudentGroup $groups
     * @return StudentCourse
     */
    public function addGroup(\Melk\ProgrTeach\MainBundle\Entity\StudentGroup $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Melk\ProgrTeach\MainBundle\Entity\StudentGroup $groups
     */
    public function removeGroup(\Melk\ProgrTeach\MainBundle\Entity\StudentGroup $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
