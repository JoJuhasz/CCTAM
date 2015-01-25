<?php

namespace Ccta\AllianceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recruit
 *
 * @ORM\Table(name="ccta_recruit")
 * @ORM\Entity(repositoryClass="Ccta\AllianceBundle\Entity\RecruitRepository")
 */
class Recruit
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\PlayerBundle\Entity\Player")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $player;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\AllianceBundle\Entity\Alliance")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $alliance;

	public function __construct()
	{
		$this->setCreatedAt(new \DateTime());
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
     * Set title
     *
     * @param string $title
     * @return Recruit
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Recruit
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Recruit
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
     * Set player
     *
     * @param string $player
     * @return Recruit
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return string 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set alliance
     *
     * @param string $alliance
     * @return Recruit
     */
    public function setAlliance($alliance)
    {
        $this->alliance = $alliance;

        return $this;
    }

    /**
     * Get alliance
     *
     * @return string 
     */
    public function getAlliance()
    {
        return $this->alliance;
    }
}
