<?php

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Topic;

class LoadTopic implements FixtureInterface{
    public function load(ObjectManager $manager){
        
        $names=$qb->getQuery()->getArrayResult();
               
        foreach ($names as $newTopicName){
            $topic = new Topic();
            $topic->setName($newTopicName);
            
            $manager->persist ($topic);
             $newTopicName['content'];
        }
        $manager->flush();
    }
}
