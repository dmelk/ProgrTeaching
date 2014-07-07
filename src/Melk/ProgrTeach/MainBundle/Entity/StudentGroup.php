<?php

namespace Melk\ProgrTeach\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StudentGroup
 */
class StudentGroup
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
     * @var \Melk\ProgrTeach\MainBundle\Entity\StudentYear
     */
    private $year;

    /**
     * @var \Melk\ProgrTeach\MainBundle\Entity\StudentCourse
     */
    private $course;


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
     * @return StudentGroup
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
     * Set year
     *
     * @param \Melk\ProgrTeach\MainBundle\Entity\StudentYear $year
     * @return StudentGroup
     */
    public function setYear(\Melk\ProgrTeach\MainBundle\Entity\StudentYear $year = null)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return \Melk\ProgrTeach\MainBundle\Entity\StudentYear
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set course
     *
     * @param \Melk\ProgrTeach\MainBundle\Entity\StudentCourse $course
     * @return StudentGroup
     */
    public function setCourse(\Melk\ProgrTeach\MainBundle\Entity\StudentCourse $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \Melk\ProgrTeach\MainBundle\Entity\StudentCourse 
     */
    public function getCourse()
    {
        return $this->course;
    }
}
