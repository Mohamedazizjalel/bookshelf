<?php
namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create 5 categories
        $categories = [];
        $categoryNames = ['Fiction', 'Science', 'History', 'Technology', 'Philosophy'];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setDescription($faker->sentence());
            $manager->persist($category);
            $categories[] = $category;
        }

        // Create 20 books
        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle($faker->sentence(3));
            $book->setAuthor($faker->name());
            $book->setDescription($faker->paragraph());
            $book->setIsbn($faker->isbn13());
            $book->setPublishedYear($faker->numberBetween(1950, 2024));
            $book->setCategory($categories[array_rand($categories)]);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
