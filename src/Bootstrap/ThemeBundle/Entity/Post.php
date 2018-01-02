<?php

namespace Bootstrap\ThemeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;

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
     * @param \FOS\UserBundle\Entity\User $usernames
     *
     * @return Post
     */
    public function setUsernames(\FOS\UserBundle\Entity\User $usernames)
    {
        $this->usernames = $usernames;

        return $this;
    }

    /**
     * Get usernames
     *
     * @return \FOS\UserBundle\Entity\User
     */
    public function getUsernames()
    {
        return $this->usernames;
    }
}
