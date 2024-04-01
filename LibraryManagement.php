<?php
class Book
{
    public function __construct(
        public string $title,
        public string $author,
        public string $publication,
        public string $genre,
        public string $uniqueNumber
    ) {}
}

class Collection
{
    public array $books = [];
    public array $borrowedBooks = [];

    public function bookTitles(): array 
    {
        return array_keys($this->books);
    }

    public function isBookAvailable(string $title): bool
    {
        return isset($this->books[$title]) && count($this->books[$title]) > 0;
    }

    public function withdraw(Patron $patron, string $title): Book
    {
        if ($this->isBookAvailable($title)) {
            $book = array_pop($this->books[$title]);
            $this->borrowedBooks[$patron->id][$book->uniqueNumber] = true;
            return $book;
        }
        throw new Exception('Book not available');
    }

    public function returnBook(Patron $patron, Book $book) 
    {
        if (isset($this->borrowedBooks[$patron->id][$book->uniqueNumber])) {
            unset($this->borrowedBooks[$patron->id][$book->uniqueNumber]);
            $this->books[$book->title][] = $book;
        }
    }

    public function addBook(Book $book)
    {
        $this->books[$book->title][] = $book;
    }
}

class Patron
{
    public function __construct(
        public int $id,
        public string $name
    ) {}
}

$book = new Book('Veera is doing', 'Veera', 'Aravind Publication', 'Comedy', 2024, '123456');
$collection = new Collection;
$collection->addBook($book);
$patron = new Patron(1, 'Mythelei');
$withdrawnBook = $collection->withdraw($patron, $book->title);
