<?php

namespace Ccta\AllianceBundle\Entity;

use Ccta\PlayerBundle\Entity\Player;
use Ccta\WorldBundle\Entity\World;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * Image path
	 *
	 * @var string
	 *
	 * @ORM\Column(type="string", name="image_path", length=255, nullable=true)
	 */
	protected $imagePath;

	/**
	 * Image file
	 *
	 * @var File
	 *
	 * @Assert\File(
	 *     maxSize = "1M",
	 *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
	 *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
	 *     mimeTypesMessage = "Only the filetypes image are allowed."
	 * )
	 */
	protected $imageFile;

	/**
	 * @ORM\Column(name="recruit_status", type="integer", options={"unsigned":true, "default":1})
	 */
	protected $recruitStatus;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\WorldBundle\Entity\World", cascade={"persist"})
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
     * @param AlliancePlayer $player
     * @return Alliance
     */
    public function addPlayer(AlliancePlayer $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove players
     *
     * @param AlliancePlayer $player
     */
    public function removePlayer(AlliancePlayer $player)
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

    /**
     * Set recruitStatus
     *
     * @param integer $recruitStatus
     * @return Alliance
     */
    public function setRecruitStatus($recruitStatus)
    {
        $this->recruitStatus = $recruitStatus;

        return $this;
    }

    /**
     * Get recruitStatus
     *
     * @return integer 
     */
    public function getRecruitStatus()
    {
        return $this->recruitStatus;
    }

	/**
	 * Set imagePath
	 *
	 * @param string $imagePath
	 * @return User
	 */
	public function setImagePath($imagePath)
	{
		$this->imagePath = $imagePath;

		return $this;
	}

	/**
	 * Get imagePath
	 *
	 * @return string
	 */
	public function getImagePath()
	{
		return $this->imagePath;
	}


	/**
	 * @return File
	 */
	public function getImageFile()
	{
		return $this->imageFile;
	}

	/**
	 * @param File $imageFile
	 */
	public function setImageFile($imageFile)
	{
		$this->imageFile = $imageFile;
	}



	/**
	 * Called before saving the entity
	 *
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function preUpload()
	{
		if (null !== $this->imageFile) {
			// do whatever you want to generate a unique name
			$filename = "image_alliance_".uniqid(rand(100,999)."_");
			$this->imagePath = $filename.'.'.$this->imageFile->guessExtension();
		}
	}

	/**
	 * Called before entity removal
	 *
	 * @ORM\PreRemove()
	 */
	public function removeUpload()
	{
		if ($file = $this->getAbsolutePath()) {
			unlink($file);
		}
	}

	/**
	 * Called after entity persistence
	 *
	 * @ORM\PostPersist()
	 * @ORM\PostUpdate()
	 */
	public function upload()
	{

		if (null === $this->imageFile) {
			return;
		}

		// move takes the target directory and then the
		// target filename to move to
		$this->imageFile->move(
			$this->getUploadRootDir(),
			$this->imagePath
		);

		// Set the path property to the filename where you've saved the file
		//$this->path = $this->file->getClientOriginalName();

		// Clean up the file property as you won't need it anymore
		$this->imageFile = null;
	}

	protected function getUploadDir()
	{
		// On retourne le chemin relatif vers l'image pour un navigateur
		return 'uploads/alliance/images';
	}

	protected function getUploadRootDir()
	{
		// On retourne le chemin relatif vers l'image pour notre code PHP
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}

	public function getAbsolutePath()
	{
		return $this->getUploadRootDir()."/".$this->imagePath;
	}

	public function getWebPath()
	{
		return $this->getUploadDir()."/".$this->imagePath;
	}

	public function getOwner()
	{
		$players = $this->getPlayers();
		foreach($players as $player) {
			if($player->getRole() == "CCTA_ROLE_ALLIANCE_OWNER") {
				return $player;
			}
		}
	}
}
