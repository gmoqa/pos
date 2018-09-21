<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class ProductFixtures
 * @package App\DataFixtures
 */
class ProductFixtures extends Fixture
{
    /**
     * @var integer
     */
    private static $quantity = 100;
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 1; $i <= self::$quantity; $i++) {
            $product = new Product();
            $product->setName($faker->domainWord);
            $product->setSku($faker->numberBetween(1111111111,9999999999));
            $product->setDescription($faker->sentence(6, true));
            $product->setCreateadAt($faker->dateTime($max = 'now', $timezone = null));
            $product->setUpdatedAt($faker->dateTime($max = 'now', $timezone = null));
            $manager->persist($product);
        }
        
        $manager->flush();
    }
}
