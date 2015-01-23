<?php

namespace Ccta\AllianceBundle\Entity;

use Ccta\PlayerBundle\Entity\Player;
use Ccta\WorldBundle\Entity\World;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Alliance
 *
 * @ORM\Table(name="ccta_alliance")
 * @ORM\Entity(repositoryClass="Ccta\AllianceBundle\Entity\AllianceRepository")
 */
class Alliance
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
     * @var string
     *
     * @ORM\Column(name="abbr", type="string", length=10)
     */
    private $abbr;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255)
     */
    private $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\WorldBundle\Entity\World")
	 */
	protected $world;

	/**
	 * @ORM\OneToMany(targetEntity="Ccta\AllianceBundle\Entity\AlliancePlayer", mappedBy="alliance")
	 */
	protected $players;


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
     * @return Alliance
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
     * Set abbr
     *
     * @param string $abbr
     * @return Alliance
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string 
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set intro
     *
     * @param string $intro
     * @return Alliance
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string 
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Alliance
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
    }

    /**
     * Set world
     *
     * @param World $world
     * @return Alliance
     */
    public function setWorld(World $world = null)
    {
        $this->world = $world;

        return $this;
    }

    /**
     * Get world
     *
     * @return World
     */
    public function getWorld()
    {
        return $this->world;
    }

    /**
     * Add players
     *
     * @param Player $player
     * @return Alliance
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
