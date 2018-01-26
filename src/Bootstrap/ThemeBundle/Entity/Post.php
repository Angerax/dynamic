<?php

namespace Bootstrap\ThemeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Bootstrap\ThemeBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @Assert\Regex(pattern="/https:\/\/www.house-mixes.com|https:\/\/www.youtube+(\.[a-z]{2,3})|https:\/\/youtu+(\.[a-z]{2,3})|https:\/\/soundcloud.com|https:\/\/www.mixcloud.com/", message="Le lien doit venir de Youtube, Soundcloud, House-mixes ou Mixcloud")
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;
    
    /**
     * @var string
     * 
     * @Assert\Regex(pattern="/<iframe.*https:\/\/www.house-mixes.com|<iframe.*https:\/\/www.youtube+(\.[a-z]{2,3})|<iframe.*https:\/\/youtu+(\.[a-z]{2,3})|<iframe.*https:\/\/soundcloud.com|<iframe.*https:\/\/www.mixcloud.com/", message="Le lien doit venir d'un embed de Youtube, Soundcloud, House-mixes ou Mixcloud")
     *
     * @ORM\Column(name="embed", type="text", nullable=true)
     */
    private $embed;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bootstrap\ThemeBundle\Entity\Topic", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $topics;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bootstrap\ThemeBundle\Entity\Users", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $usernames;
    
    /**
     * @var date
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;


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
     * Set url
     *
     * @param string $url
     *
     * @return Post
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Post
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->topics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime('now');
    }

    /**
     * Set topics
     *
     * @param \Bootstrap\ThemeBundle\Entity\Topic $topics
     *
     * @return Post
     */
    public function setTopics(\Bootstrap\ThemeBundle\Entity\Topic $topics)
    {
        $this->topics = $topics;

        return $this;
    }

    /**
     * Get topics
     *
     * @return \Bootstrap\ThemeBundle\Entity\Topic
     */
    public function getTopics()
    {
        return $this->topics;
    }

    

    /**
     * Set usernames
     *
     * @param \Bootstrap\ThemeBundle\Entity\Users $usernames
     *
     * @return Post
     */
    public function setUsernames(\Bootstrap\ThemeBundle\Entity\Users $usernames)
    {
        $this->usernames = $usernames;

        return $this;
    }

    /**
     * Get usernames
     *
     * @return \Bootstrap\ThemeBundle\Entity\Users
     */
    public function getUsernames()
    {
        return $this->usernames;
    }

    /**
     * Set embed
     *
     * @param string $embed
     *
     * @return Post
     */
    public function setEmbed($embed)
    {
        $this->embed = $embed;

        return $this;
    }

    /**
     * Get embed
     *
     * @return string
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
