<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bootstrap\ThemeBundle\Entity;

/**
 * Description of PostAndTopic
 *
 * @author Olivier
 */
class PostAndTopic {
    
    /**
     *
     * @var Post
     */
    private $post;
    /**
     *
     * @var Topic
     */
    private $topic;
    
    public function setPost(Post $post){
        $this->post = $post;
        return $this;
    }
    
    public function getPost(){
        return $this->post;
    }
    
    public function setTopic(Topic $topic){
        $this->topic = $topic;
        return $this;
    }
    
    public function getTopic(){
        return $this->topic;
    }
}
