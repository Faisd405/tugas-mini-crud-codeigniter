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
    
    // Validation rules
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'author' => 'required|min_length[3]|max_length[255]',
        'isbn' => 'required|min_length[10]|max_length[20]|is_unique[books.isbn,id,{id}]',
        'publisher' => 'required|min_length[3]|max_length[255]',
        'year_published' => 'required|integer|greater_than[1900]|less_than_equal_to[2025]',
        'pages' => 'required|integer|greater_than[0]',
        'category' => 'required|min_length[3]|max_length[100]',
        'stock' => 'required|integer|greater_than_equal_to[0]',
        'status' => 'required|in_list[available,borrowed,maintenance]'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Title is required',
            'min_length' => 'Title must be at least 3 characters long',
            'max_length' => 'Title cannot exceed 255 characters'
        ],
        'author' => [
            'required' => 'Author is required',
            'min_length' => 'Author must be at least 3 characters long',
            'max_length' => 'Author cannot exceed 255 characters'
        ],
        'isbn' => [
            'required' => 'ISBN is required',
            'min_length' => 'ISBN must be at least 10 characters long',
            'max_length' => 'ISBN cannot exceed 20 characters',
            'is_unique' => 'ISBN already exists'
        ],
        'publisher' => [
            'required' => 'Publisher is required',
            'min_length' => 'Publisher must be at least 3 characters long',
            'max_length' => 'Publisher cannot exceed 255 characters'
        ],
        'year_published' => [
            'required' => 'Year published is required',
            'integer' => 'Year published must be a number',
            'greater_than' => 'Year published must be greater than 1900',
            'less_than_equal_to' => 'Year published cannot be in the future'
        ],
        'pages' => [
            'required' => 'Pages is required',
            'integer' => 'Pages must be a number',
            'greater_than' => 'Pages must be greater than 0'
        ],
        'category' => [
            'required' => 'Category is required',
            'min_length' => 'Category must be at least 3 characters long',
            'max_length' => 'Category cannot exceed 100 characters'
        ],
        'stock' => [
            'required' => 'Stock is required',
            'integer' => 'Stock must be a number',
            'greater_than_equal_to' => 'Stock cannot be negative'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be available, borrowed, or maintenance'
        ]
    ];
    
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
