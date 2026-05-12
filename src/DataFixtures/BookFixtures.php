<?php
namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cat1 = new Category();
        $cat1->setName('Fiction');
        $manager->persist($cat1);

        $cat2 = new Category();
        $cat2->setName('Science');
        $manager->persist($cat2);

        $books = [
            ['1984', 'George Orwell', $cat1, 1949],
            ['Brave New World', 'Aldous Huxley', $cat1, 1932],
            ['A Brief History of Time', 'Stephen Hawking', $cat2, 1988],
            ['Cosmos', 'Carl Sagan', $cat2, 1980],
        ];

        foreach ($books as [$title, $author, $category, $year]) {
            $book = new Book();
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setCategory($category);
            $book->setPublishedYear($year);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
