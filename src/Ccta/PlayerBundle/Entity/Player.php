<?php

namespace Ccta\PlayerBundle\Entity;

use Ccta\UserBundle\Entity\User;
use Ccta\WorldBundle\Entity\World;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Player
 *
 * @ORM\Table(name="ccta_player")
 * @ORM\Entity(repositoryClass="Ccta\PlayerBundle\Entity\PlayerRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Player
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
     * @ORM\Column(name="playername", type="string", length=255)
     */
	protected $playername;

    /**
     * @var string
     *
     * @ORM\Column(name="intro", type="string", length=255)
     */
	protected $intro;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
	protected $description;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\UserBundle\Entity\User", inversedBy="players")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $user;

	/**
	 * @ORM\ManyToMany(targetEntity="Ccta\WorldBundle\Entity\World", mappedBy="players", cascade={"persist","remove"}, fetch="EAGER")
	 * @ORM\JoinColumn(nullable=true)
	 */
	private $worlds;

	/**
	 * @ORM\OneToMany(targetEntity="Ccta\AllianceBundle\Entity\AlliancePlayer", mappedBy="player")
	 */
	protected $alliances;

	/**
	 * Avatar path
	 *
	 * @var string
	 *
	 * @ORM\Column(type="string", name="avatar_path", length=255, nullable=true)
	 */
	protected $avatarPath;

	/**
	 * Avatar file
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
	protected $avatarFile;

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
     * Set playername
     *
     * @param string $playername
     * @return Player
     */
    public function setPlayername($playername)
    {
        $this->playername = $playername;

        return $this;
    }

    /**
     * Get playername
     *
     * @return string 
     */
    public function getPlayername()
    {
        return $this->playername;
    }

    /**
     * Set intro
     *
     * @param string $intro
     * @return Player
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
     * @return Player
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
	 * Set avatarPath
	 *
	 * @param string $avatarPath
	 * @return User
	 */
	public function setAvatarPath($avatarPath)
	{
		$this->avatarPath = $avatarPath;

		return $this;
	}

	/**
	 * Get avatarPath
	 *
	 * @return string
	 */
	public function getAvatarPath()
	{
		return $this->avatarPath;
	}


	/**
	 * @return File
	 */
	public function getAvatarFile()
	{
		return $this->avatarFile;
	}

	/**
	 * @param File $avatarFile
	 */
	public function setAvatarFile($avatarFile)
	{
		$this->avatarFile = $avatarFile;
	}



	/**
	 * Called before saving the entity
	 *
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function preUpload()
	{
		if (null !== $this->avatarFile) {
			// do whatever you want to generate a unique name
			$filename = "avatar_player_".uniqid(rand(100,999)."_");
			$this->avatarPath = $filename.'.'.$this->avatarFile->guessExtension();
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

		if (null === $this->avatarFile) {
			return;
		}

		// move takes the target directory and then the
		// target filename to move to
		$this->avatarFile->move(
			$this->getUploadRootDir(),
			$this->avatarPath
		);

		// Set the path property to the filename where you've saved the file
		//$this->path = $this->file->getClientOriginalName();

		// Clean up the file property as you won't need it anymore
		$this->avatarFile = null;
	}

	protected function getUploadDir()
	{
		// On retourne le chemin relatif vers l'image pour un navigateur
		return 'uploads/avatars';
	}

	protected function getUploadRootDir()
	{
		// On retourne le chemin relatif vers l'image pour notre code PHP
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}

	public function getAbsolutePath()
	{
		return $this->getUploadRootDir()."/".$this->avatarPath;
	}

	public function getWebPath()
	{
		return $this->getUploadDir()."/".$this->avatarPath;
	}

    /**
     * Set user
     *
     * @param User $user
     * @return Player
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->worlds = new ArrayCollection();
    }

    /**
     * Add worlds
     *
     * @param World $world
     * @return Player
     */
    public function addWorld(World $world)
    {
        $this->worlds[] = $world;

        return $this;
    }

    /**
     * Remove worlds
     *
     * @param World $world
     */
    public function removeWorld(World $world)
    {
        $this->worlds->removeElement($world);
    }

    /**
     * Get worlds
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWorlds()
    {
        return $this->worlds;
    }
}
