<?php

namespace Ccta\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="ccta_user")
 * @ORM\Entity(repositoryClass="Ccta\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
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
	 *     maxSize = "5M",
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
			$filename = "avatar_user_".uniqid(rand(100,999)."_");
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

}
