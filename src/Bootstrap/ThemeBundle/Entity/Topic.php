<?php

namespace Bootstrap\ThemeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 * 
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="Bootstrap\ThemeBundle\Repository\TopicRepository")
 */
class Topic
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=50)
     */
    private $tag;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bootstrap\ThemeBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    protected $categories;
    

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
     * @return Topic
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
     * Set tag
     *
     * @param string $tag
     *
     * @return Topic
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set categories
     *
     * @param \Bootstrap\ThemeBundle\Entity\Category $categories
     *
     * @return Topic
     */
    public function setCategories(\Bootstrap\ThemeBundle\Entity\Category $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return \Bootstrap\ThemeBundle\Entity\Category
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
