<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public $table = 'statuses';

    const STATUS_OPEN = 'Open';

    const STATUS_CLOSED = 'Closed';

    const STATUS = [
        'OPEN' => 1,
        'CLOSED' => 0,
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
        return $this->hasMany(Ticket::class, 'status_id', 'id');
    }
}
