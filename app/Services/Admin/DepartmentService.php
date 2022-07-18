<?php

namespace App\Services\Admin;

use App\Models\Department;
use App\Repositories\Eloquent\DepartmentRepository;

class DepartmentService
{
    /**
     * The Configuration repository instance.
     *
     * @var DepartmentRepository
     */

    private $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public  function show($collections = [], $id)
    {
        return $this->repository->find($collections, $id);
    }

    public  function create($attributes = [])
    {
        return $this->repository->create($attributes);
    }
}
