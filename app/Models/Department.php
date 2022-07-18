<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $table = 'departments';

    const DEPARTMENTS = [
        'TST_DEPARTMENTS' => 'TST',
        'FINANCE_DEPARTMENTS' => 'FINANCE',
        'PHP_DEPARTMENTS' => 'PHP',
        'ADMIN_DEPARTMENTS' => 'ADMINISTRATOR'
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

    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
