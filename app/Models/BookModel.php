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
}
