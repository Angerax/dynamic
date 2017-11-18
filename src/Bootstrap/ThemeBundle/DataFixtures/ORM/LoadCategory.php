<?php
namespace Bootstrap\ThemeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bootstrap\ThemeBundle\Entity\Category;

class LoadCategory implements FixtureInterface {
     public function load(ObjectManager $manager){
         $names;
     
     foreach ($names as $newCategoryName){
            $category = new Category();
            $category->setName($newCategoryName);
            
            $manager->persist($category);
     }
     $manager->flush();
}
}
