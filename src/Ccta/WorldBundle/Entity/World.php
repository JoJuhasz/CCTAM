<?php

namespace Ccta\WorldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * World
 *
 * @ORM\Table(name="ccta_world")
 * @ORM\Entity(repositoryClass="Ccta\WorldBundle\Entity\WorldRepository")
 */
class World
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="open_at", type="datetime")
	 */
	private $openAt;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created_at", type="datetime")
	 */
	private $createdAt;


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
     * @return World
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return World
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set openAt
     *
     * @param \DateTime $openAt
     * @return World
     */
    public function setOpenAt($openAt)
    {
        $this->openAt = $openAt;

        return $this;
    }

    /**
     * Get openAt
     *
     * @return \DateTime 
     */
    public function getOpenAt()
    {
        return $this->openAt;
    }
}
