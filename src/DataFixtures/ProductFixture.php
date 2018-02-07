<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager) {
        
        for($i=1; $i <= 40; $i++){
            $product = new Product();
            $product->setName("Product n°".$i);
            $product->setDescription("Description of Product n°".$i);
            $product->setImage('uploads/product/dummy.png');
            $product->setState('average');
            
            $user = $this->getReference('user'.rand(1,20));
            $product->setUser($user);
            
            $manager->persist($product);
            
            $this->addReference('product'.$i, $product);
        }
        $manager->flush();
        
    }

    public function getDependencies(): array {
        return [
            UserFixture::class
        ];
    }

}
