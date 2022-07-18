<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory;

    public $table = 'article_comments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comment',
        'user_id',
        'knowledge_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function knowledge()
    {
        return $this->belongsTo(KnowledgeBase::class, 'knowledge_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
