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

            // Add file upload validation rules if files are uploaded
            $coverImage = $this->request->getFile('cover_image');
            $digitalFile = $this->request->getFile('digital_file');

            if ($coverImage && $coverImage->isValid()) {
                $rules['cover_image'] = 'uploaded[cover_image]|is_image[cover_image]|max_size[cover_image,2048]';
            }

            if ($digitalFile && $digitalFile->isValid()) {
                $rules['digital_file'] = 'uploaded[digital_file]|max_size[digital_file,10240]';
            }

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

                // Save book first to get ID
                $bookId = $this->bookModel->insert($bookData);

                // Handle cover image upload
                if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
                    $uploadResult = $this->bookModel->uploadCoverImage($bookId, $coverImage);
                    if (!$uploadResult) {
                        session()->setFlashdata('error', 'Failed to upload cover image');
                    }
                }

                // Handle digital file upload
                if ($digitalFile && $digitalFile->isValid() && !$digitalFile->hasMoved()) {
                    $uploadResult = $this->bookModel->uploadDigitalFile($bookId, $digitalFile);
                    if (!$uploadResult) {
                        session()->setFlashdata('error', 'Failed to upload digital file');
                    }
                }

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

            // Add file upload validation rules if files are uploaded
            $coverImage = $this->request->getFile('cover_image');
            $digitalFile = $this->request->getFile('digital_file');

            if ($coverImage && $coverImage->isValid()) {
                $rules['cover_image'] = 'uploaded[cover_image]|is_image[cover_image]|max_size[cover_image,2048]';
            }

            if ($digitalFile && $digitalFile->isValid()) {
                $rules['digital_file'] = 'uploaded[digital_file]|max_size[digital_file,10240]';
            }

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

                // Update book data
                $this->bookModel->update($id, $bookData);

                // Handle cover image upload
                if ($coverImage && $coverImage->isValid() && !$coverImage->hasMoved()) {
                    // Delete old cover image if exists
                    $existingBook = $this->bookModel->find($id);
                    if ($existingBook->cover_image) {
                        $oldImagePath = WRITEPATH . 'uploads/covers/' . $existingBook->cover_image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    
                    $uploadResult = $this->bookModel->uploadCoverImage($id, $coverImage);
                    if (!$uploadResult) {
                        session()->setFlashdata('error', 'Failed to upload cover image');
                    }
                }

                // Handle digital file upload
                if ($digitalFile && $digitalFile->isValid() && !$digitalFile->hasMoved()) {
                    // Delete old digital file if exists
                    $existingBook = $this->bookModel->find($id);
                    if ($existingBook->digital_file) {
                        $oldFilePath = WRITEPATH . 'uploads/digital_files/' . $existingBook->digital_file;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    
                    $uploadResult = $this->bookModel->uploadDigitalFile($id, $digitalFile);
                    if (!$uploadResult) {
                        session()->setFlashdata('error', 'Failed to upload digital file');
                    }
                }

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

    /**
     * Serve cover image
     */
    public function coverImage($filename = null)
    {
        if (!$filename) {
            throw new PageNotFoundException('Image not found');
        }

        $path = WRITEPATH . 'uploads/covers/' . $filename;

        if (!is_file($path)) {
            // If no file found, redirect to default image
            return redirect()->to('/images/default-book-cover.png');
        }

        $mime = mime_content_type($path);
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Cache-Control', 'public, max-age=31536000')
            ->setBody(file_get_contents($path));
    }

    /**
     * Serve digital file (with access control)
     */
    public function digitalFile($filename = null)
    {
        if (!$filename) {
            throw new PageNotFoundException('File not found');
        }

        // Add access control - check if user is logged in and has permission
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access digital files');
            return redirect()->to('/auth/login');
        }

        $path = WRITEPATH . 'uploads/digital_files/' . $filename;

        if (!is_file($path)) {
            throw new PageNotFoundException('File not found');
        }

        $mime = mime_content_type($path);
        $fileInfo = pathinfo($path);
        
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Disposition', 'inline; filename="' . $fileInfo['basename'] . '"')
            ->setHeader('Cache-Control', 'private, max-age=3600')
            ->setBody(file_get_contents($path));
    }

    /**
     * Delete cover image
     */
    public function deleteCoverImage($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Book not found');
        }

        if ($this->bookModel->deleteCoverImage($id)) {
            session()->setFlashdata('success', 'Cover image deleted successfully');
        } else {
            session()->setFlashdata('error', 'Failed to delete cover image');
        }

        return redirect()->to(site_url('admin/book/edit/' . $id));
    }

    /**
     * Delete digital file
     */
    public function deleteDigitalFile($id = null)
    {
        if ($id == null) {
            throw new PageNotFoundException('Book not found');
        }

        if ($this->bookModel->deleteDigitalFile($id)) {
            session()->setFlashdata('success', 'Digital file deleted successfully');
        } else {
            session()->setFlashdata('error', 'Failed to delete digital file');
        }

        return redirect()->to(site_url('admin/book/edit/' . $id));
    }
}
