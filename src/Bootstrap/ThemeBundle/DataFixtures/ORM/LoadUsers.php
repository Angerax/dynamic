<?php

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Users;

class LoadCategory implements FixtureInterface{
    public function load(ObjectManager $manager){
        
        $names=$qb->getQuery()->getArrayResult();
               
        foreach ($names as $newUsersName){
            $users = new Users();
            $users->setName($newUsersName);
            
            $manager->persist ($users);
             $newUsersName['content'];
        }
        $manager->flush();
    }
}
