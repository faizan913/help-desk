<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;
    public $table = 'priorities';


    const PRIORITIES = [
        'PRIORITY_LOW' => 'Low',
        'PRIORITY_MEDIUM' => "Medium",
        'PRIORITY_HIGH' => 'High',
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
        return $this->hasMany(Ticket::class, 'priority_id', 'id');
    }
}
