<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'title', 'author', 'isbn', 'publisher', 'year_published', 
        'pages', 'category', 'description', 'stock', 'cover_image', 
        'digital_file', 'status', 'created_at', 'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    /**
     * Get available books (not borrowed)
     */
    public function getAvailableBooks($limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->where('status', 'available');
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResult();
    }
    
    /**
     * Search books by title, author, or category
     */
    public function searchBooks($keyword, $limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->groupStart()
                ->like('title', $keyword)
                ->orLike('author', $keyword)
                ->orLike('category', $keyword)
                ->orLike('publisher', $keyword)
                ->groupEnd();
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get books by category
     */
    public function getBooksByCategory($category, $limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->where('category', $category);
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get books count for search
     */
    public function searchBooksCount($keyword)
    {
        $builder = $this->builder();
        $builder->groupStart()
                ->like('title', $keyword)
                ->orLike('author', $keyword)
                ->orLike('category', $keyword)
                ->orLike('publisher', $keyword)
                ->groupEnd();
        
        return $builder->countAllResults();
    }
    
    /**
     * Get all categories
     */
    public function getCategories()
    {
        $builder = $this->builder();
        $builder->select('category')
                ->distinct()
                ->orderBy('category', 'ASC');
        
        return $builder->get()->getResult();
    }
    
    /**
     * Get books with pagination
     */
    public function getBooksWithPagination($limit, $offset)
    {
        $builder = $this->builder();
        $builder->limit($limit, $offset);
        
        return $builder->get()->getResult();
    }
    
    /**
     * Upload cover image for book
     */
    public function uploadCoverImage($bookId, $file)
    {
        $uploadPath = WRITEPATH . 'uploads/covers/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        if ($file->isValid() && !$file->hasMoved()) {
            // Generate unique filename
            $extension = $file->getExtension();
            $newName = 'cover_' . $bookId . '_' . time() . '.' . $extension;
            
            if ($file->move($uploadPath, $newName)) {
                // Update book cover_image field
                $this->update($bookId, ['cover_image' => $newName]);
                return $newName;
            }
        }
        
        return false;
    }
    
    /**
     * Upload digital file for book
     */
    public function uploadDigitalFile($bookId, $file)
    {
        $uploadPath = WRITEPATH . 'uploads/digital_files/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        if ($file->isValid() && !$file->hasMoved()) {
            // Generate unique filename
            $extension = $file->getExtension();
            $newName = 'digital_' . $bookId . '_' . time() . '.' . $extension;
            
            if ($file->move($uploadPath, $newName)) {
                // Update book digital_file field
                $this->update($bookId, ['digital_file' => $newName]);
                return $newName;
            }
        }
        
        return false;
    }
    
    /**
     * Delete cover image file
     */
    public function deleteCoverImage($bookId)
    {
        $book = $this->find($bookId);
        if ($book && $book->cover_image) {
            $filePath = WRITEPATH . 'uploads/covers/' . $book->cover_image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->update($bookId, ['cover_image' => null]);
            return true;
        }
        return false;
    }
    
    /**
     * Delete digital file
     */
    public function deleteDigitalFile($bookId)
    {
        $book = $this->find($bookId);
        if ($book && $book->digital_file) {
            $filePath = WRITEPATH . 'uploads/digital_files/' . $book->digital_file;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->update($bookId, ['digital_file' => null]);
            return true;
        }
        return false;
    }
}
