<?php

namespace Ccta\AllianceBundle\Entity;

use Ccta\PlayerBundle\Entity\Player;
use Doctrine\ORM\Mapping as ORM;

/**
 * AlliancePlayer
 *
 * @ORM\Table(name="ccta_alliance_player")
 * @ORM\Entity(repositoryClass="Ccta\AllianceBundle\Entity\AlliancePlayerRepository")
 */
class AlliancePlayer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
	protected $role;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\AllianceBundle\Entity\Alliance", inversedBy="players", fetch="EAGER")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $alliance;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\WorldBundle\Entity\World")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $world;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\PlayerBundle\Entity\Player", inversedBy="alliances")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $player;


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
     * Set role
     *
     * @param string $role
     * @return AlliancePlayer
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set alliance
     *
     * @param \Ccta\AllianceBundle\Entity\Alliance $alliance
     * @return AlliancePlayer
     */
    public function setAlliance(Alliance $alliance)
    {
        $this->alliance = $alliance;

        return $this;
    }

    /**
     * Get alliance
     *
     * @return \Ccta\AllianceBundle\Entity\Alliance 
     */
    public function getAlliance()
    {
        return $this->alliance;
    }

	/**
	 * Set player
	 *
	 * @param \Ccta\PlayerBundle\Entity\Player $player
	 * @return AlliancePlayer
	 */
	public function setPlayer(Player $player)
	{
		$this->player = $player;

		return $this;
	}

	/**
	 * Get player
	 *
	 * @return \Ccta\PlayerBundle\Entity\Player
	 */
	public function getPlayer()
	{
		return $this->player;
	}

	/**
	 * Set world
	 *
	 * @param World $world
	 * @return AlliancePlayer
	 */
	public function setWorld(World $world)
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
}
