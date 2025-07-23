<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Book extends BaseController
{
    protected $bookModel;
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    /**
     * Display paginated list of books with search functionality
     */
    public function index()
    {
        $keyword = $this->request->getGet('search') ?? '';
        $perPage = 5;
        $page = $this->request->getGet('page') ?? 1;
        
        $pager = service('pager');
        
        if (!empty($keyword)) {
            $books = $this->bookModel->searchBooks($keyword, $perPage, ($page - 1) * $perPage);
            $totalBooks = $this->bookModel->searchBooksCount($keyword);
        } else {
            $books = $this->bookModel->getBooksWithPagination($perPage, ($page - 1) * $perPage);
            $totalBooks = $this->bookModel->countAll();
        }
        
        $data = [
            'title' => 'Book Management - Digital Library',
            'books' => $books,
            'pager' => $pager->makeLinks($page, $perPage, $totalBooks, 'bootstrap_pagination'),
            'keyword' => $keyword,
            'total' => $totalBooks,
            'currentPage' => $page,
            'perPage' => $perPage
        ];

        return view('admin/book_list', $data);
    }

    /**
     * Display form to create new book
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Book - Digital Library',
            'book' => null,
            'action' => 'create'
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'author' => 'required|min_length[3]|max_length[255]',
                'isbn' => 'required|min_length[10]|max_length[20]|is_unique[books.isbn]',
                'publisher' => 'required|min_length[3]|max_length[255]',
                'year_published' => 'required|integer|greater_than[1900]|less_than_equal_to[2025]',
                'pages' => 'required|integer|greater_than[0]',
                'category' => 'required|min_length[3]|max_length[100]',
                'stock' => 'required|integer|greater_than_equal_to[0]',
                'status' => 'required|in_list[available,borrowed,maintenance]'
            ];

            if ($this->validate($rules)) {
                $bookData = [
                    'title' => $this->request->getPost('title'),
                    'author' => $this->request->getPost('author'),
                    'isbn' => $this->request->getPost('isbn'),
                    'publisher' => $this->request->getPost('publisher'),
                    'year_published' => $this->request->getPost('year_published'),
                    'pages' => $this->request->getPost('pages'),
                    'category' => $this->request->getPost('category'),
                    'description' => $this->request->getPost('description'),
                    'stock' => $this->request->getPost('stock'),
                    'status' => $this->request->getPost('status')
                ];

                $this->bookModel->save($bookData);
                session()->setFlashdata('success', 'Book was successfully created');
                return redirect()->to(site_url('admin/book'));
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/book_form', $data);
    }

    /**
     * Display form to edit existing book
     */
    public function edit($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Book not found');
        }

        $book = $this->bookModel->find($id);
        if (!$book) {
            throw new PageNotFoundException('Book not found');
        }

        $data = [
            'title' => 'Edit Book - Digital Library',
            'book' => $book,
            'action' => 'edit'
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            $rules = [
                'title' => 'required|min_length[3]|max_length[255]',
                'author' => 'required|min_length[3]|max_length[255]',
                'isbn' => 'required|min_length[10]|max_length[20]|is_unique[books.isbn,id,' . $id . ']',
                'publisher' => 'required|min_length[3]|max_length[255]',
                'year_published' => 'required|integer|greater_than[1900]|less_than_equal_to[2025]',
                'pages' => 'required|integer|greater_than[0]',
                'category' => 'required|min_length[3]|max_length[100]',
                'stock' => 'required|integer|greater_than_equal_to[0]',
                'status' => 'required|in_list[available,borrowed,maintenance]'
            ];

            if ($this->validate($rules)) {
                $bookData = [
                    'title' => $this->request->getPost('title'),
                    'author' => $this->request->getPost('author'),
                    'isbn' => $this->request->getPost('isbn'),
                    'publisher' => $this->request->getPost('publisher'),
                    'year_published' => $this->request->getPost('year_published'),
                    'pages' => $this->request->getPost('pages'),
                    'category' => $this->request->getPost('category'),
                    'description' => $this->request->getPost('description'),
                    'stock' => $this->request->getPost('stock'),
                    'status' => $this->request->getPost('status')
                ];

                $this->bookModel->update($id, $bookData);
                session()->setFlashdata('success', 'Book was successfully updated');
                
                return redirect()->to(site_url('admin/book'));
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/book_form', $data);
    }

    /**
     * Delete book
     */
    public function delete($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Book not found');
        }

        $book = $this->bookModel->find($id);
        if (!$book) {
            throw new PageNotFoundException('Book not found');
        }

        if ($this->bookModel->delete($id)) {
            session()->setFlashdata('success', 'Book was successfully deleted');
        } else {
            session()->setFlashdata('error', 'Failed to delete book');
        }

        return redirect()->to(site_url('admin/book'));
    }

    /**
     * View book details
     */
    public function view($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Book not found');
        }

        $book = $this->bookModel->find($id);
        if (!$book) {
            throw new PageNotFoundException('Book not found');
        }

        $data = [
            'title' => 'Book Details - ' . $book->title,
            'book' => $book
        ];

        return view('admin/book_view', $data);
    }
}
