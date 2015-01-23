<?php

namespace Ccta\AllianceBundle\Entity;

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
	 * @ORM\ManyToOne(targetEntity="Ccta\AllianceBundle\Entity\Alliance", inversedBy="players")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $alliance;

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
}
