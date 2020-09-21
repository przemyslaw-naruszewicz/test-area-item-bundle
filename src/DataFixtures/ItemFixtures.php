<?php

namespace TestArea\ItemBundle\DataFixtures;

use TestArea\ItemBundle\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ItemFixtures
 * @package App\DataFixtures
 */
class ItemFixtures extends Fixture
{
    private const ITEMS = [
        [
            'name' => 'Produkt 1',
            'amount' => 4,
        ],
        [
            'name' => 'Produkt 2',
            'amount' => 12,
        ],
        [
            'name' => 'Produkt 5',
            'amount' => 0,
        ],
        [
            'name' => 'Produkt 7',
            'amount' => 6,
        ],
        [
            'name' => 'Produkt 8',
            'amount' => 2,
        ],
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach(self::ITEMS as $item) {
            $itemObject = new Item();
            $itemObject->setName($item['name']);
            $itemObject->setAmount($item['amount']);
            $manager->persist($itemObject);
        }

        $manager->flush();
    }
}
