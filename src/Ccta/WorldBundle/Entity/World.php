<?php

namespace Ccta\WorldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ccta\PlayerBundle\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * World
 *
 * @ORM\Table(name="ccta_world")
 * @ORM\Entity(repositoryClass="Ccta\WorldBundle\Entity\WorldRepository")
 * @ORM\HasLifecycleCallbacks
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
	 * @var int
	 *
	 * @ORM\Column(name="max_players", type="integer")
	 */
	private $maxPlayers;

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
	 * @ORM\ManyToMany(targetEntity="Ccta\PlayerBundle\Entity\Player", inversedBy="worlds", cascade={"persist","remove"})
	 * @ORM\JoinTable(name="player_world")
	 * @ORM\JoinColumn(nullable=true)
	 */
	private $players;


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

    /**
     * Set maxPlayers
     *
     * @param integer $maxPlayers
     * @return World
     */
    public function setMaxPlayers($maxPlayers)
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    /**
     * Get maxPlayers
     *
     * @return integer 
     */
    public function getMaxPlayers()
    {
        return $this->maxPlayers;
    }

	/**
	 * Called before saving the entity
	 *
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function updateDate()
	{
		if (is_null($this->getCreatedAt())) {
			$this->setCreatedAt(new \DateTime());
		}
	}
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    /**
     * Add players
     *
     * @param Player $player
     * @return World
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove players
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
}
