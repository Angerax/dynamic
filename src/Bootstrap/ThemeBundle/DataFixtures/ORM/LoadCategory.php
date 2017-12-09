<?php

namespace Admin\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admin\AdminBundle\Entity\Category;

class LoadCategory implements FixtureInterface{
    public function load(ObjectManager $manager){
        $names=name;
               
        foreach ($names as $newCategoryName){
            $category = new Category();
            $category->setName($newCategoryName);
            
            $manager->persist ($category);
        }
        $manager->flush();
    }
}
