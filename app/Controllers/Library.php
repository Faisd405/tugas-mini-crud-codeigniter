<?php

namespace App\Controllers;

use App\Models\BookModel;

class Library extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    /**
     * Display library homepage with search and pagination
     */
    public function index()
    {
        $keyword = $this->request->getGet('search') ?? '';
        $category = $this->request->getGet('category') ?? '';
        $perPage = 8;
        $page = $this->request->getGet('page') ?? 1;
        
        $pager = service('pager');
        
        if (!empty($keyword)) {
            $books = $this->bookModel->searchBooks($keyword, $perPage, ($page - 1) * $perPage);
            $totalBooks = $this->bookModel->searchBooksCount($keyword);
        } elseif (!empty($category)) {
            $books = $this->bookModel->getBooksByCategory($category, $perPage, ($page - 1) * $perPage);
            $totalBooks = $this->bookModel->where('category', $category)->countAllResults();
        } else {
            $books = $this->bookModel->getAvailableBooks($perPage, ($page - 1) * $perPage);
            $totalBooks = $this->bookModel->where('status', 'available')->countAllResults();
        }
        
        $categories = $this->bookModel->getCategories();
        
        $data = [
            'title' => 'Digital Library - Browse Books',
            'books' => $books,
            'categories' => $categories,
            'pager' => $pager->makeLinks($page, $perPage, $totalBooks, 'bootstrap_pagination'),
            'keyword' => $keyword,
            'selectedCategory' => $category,
            'total' => $totalBooks,
            'currentPage' => $page,
            'perPage' => $perPage
        ];

        return view('library/index', $data);
    }

    /**
     * Display book details
     */
    public function book($id = null)
    {
        if ($id == null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Book not found');
        }

        $book = $this->bookModel->find($id);
        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Book not found');
        }

        // Get related books from same category
        $relatedBooks = $this->bookModel->getBooksByCategory($book->category, 4);
        
        // Remove current book from related books
        $relatedBooks = array_filter($relatedBooks, function($relatedBook) use ($book) {
            return $relatedBook->id != $book->id;
        });

        $data = [
            'title' => $book->title . ' - Digital Library',
            'book' => $book,
            'relatedBooks' => $relatedBooks
        ];

        return view('library/book_detail', $data);
    }

    /**
     * Search books (AJAX endpoint)
     */
    public function search()
    {
        $keyword = $this->request->getGet('q') ?? '';
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;
        
        if (!empty($keyword)) {
            $books = $this->bookModel->searchBooks($keyword, $perPage, ($page - 1) * $perPage);
            $totalBooks = $this->bookModel->searchBooksCount($keyword);
        } else {
            $books = [];
            $totalBooks = 0;
        }
        
        $data = [
            'books' => $books,
            'total' => $totalBooks,
            'currentPage' => $page,
            'perPage' => $perPage,
            'keyword' => $keyword
        ];

        return $this->response->setJSON($data);
    }
}
