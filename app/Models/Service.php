<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $table = 'services';

    const SERVICES = [
        'SOFTWARE', 'HARDWARE', 'INTERNET'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'service_id', 'id');
    }

    public function knowledges()
    {
        return $this->hasMany(KnowledgeBase::class, 'service_id', 'id');
    }
}
