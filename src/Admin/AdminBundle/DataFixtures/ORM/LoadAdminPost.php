<?php
namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Post;

class LoadCategory implements FixtureInterface {
     public function load(ObjectManager $manager){
         $names;
     
     foreach ($names as $newPostName){
            $post = new Post();
            $post->setName($newPostName);
            
            $manager->persist($post);
     }
     $manager->flush();
}
}
