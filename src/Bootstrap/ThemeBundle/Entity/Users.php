<?php

namespace Bootstrap\ThemeBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\User;
use Bootstrap\ThemeBundle\Entity\Users;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Bootstrap\ThemeBundle\Repository\UserRepository")
 * @Vich\Uploadable
 */
class Users extends BaseUser
{
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="images", type="text", nullable=true)
     */
    protected $images= "genericIcon.png";
    
    /**
     * @Assert\File(
     *     maxSize = "5000000",
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     maxSizeMessage = "La taille maximale permise pour l'image d'un projet est de 5MB.",
     *     mimeTypesMessage = "Seuls les fichiers de type image (jpeg, png) peuvent être uploadés"
     * )
     * 
     * @Vich\UploadableField(mapping="images", fileNameProperty="images")
     * 
     * @var File $imagesFile
     */
    private $imagesFile;
    
    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private $bio;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return User
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $images
     *
     * @return images
     */
    public function setImagesFile(File $images = null)
    {
        $this->imagesFile = $images;

        if (null !== $images) 
            $this->updatedAt = new \DateTimeImmutable();
    
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImagesFile()
    {
        return $this->imagesFile;
    }
    
    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
    
    public function __construct() {
        parent::__construct();
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Users
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
