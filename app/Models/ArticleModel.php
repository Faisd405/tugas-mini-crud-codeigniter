<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['title', 'slug', 'content', 'draft', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // This method is used to get published articles only
    public function getPublished($limit = null, $offset = null)
    {
        $builder = $this->builder();
        $builder->where('draft', 0);
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResult();
    }
    
    // This method is used to find an article by slug
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}
