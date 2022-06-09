<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testGetId()
    {
        $book = new Book();
        $this->assertEmpty($book->getId());
    }

    public function testSetTitle()
    {
        $book = new Book();
        $this->assertEmpty($book->getTitle());

        $exp = "test";
        $book->setTitle($exp);
        $this->assertEquals($exp, $book->getTitle());
    }

    public function testSetIsbn()
    {
        $book = new Book();
        $this->assertEmpty($book->getIsbn());

        $exp = "123456789012";
        $book->setIsbn($exp);
        $this->assertEquals($exp, $book->getIsbn());
    }

    public function testSetAuthor()
    {
        $book = new Book();
        $this->assertEmpty($book->getAuthor());

        $exp = "Filip Lindberg";
        $book->setAuthor($exp);
        $this->assertEquals($exp, $book->getAuthor());
    }

    public function testSetImage()
    {
        $book = new Book();
        $this->assertEmpty($book->getImage());

        $exp = "image.png";
        $book->setImage($exp);
        $this->assertEquals($exp, $book->getImage());
    }
}
