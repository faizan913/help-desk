<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface StatusRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function storeStatus(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function all($relations = []): Collection;

    /**
     * Update existing model
     * @param array $attributes
     * @return bool
     */
    public function updateStatus($modelId, array $attributes): bool;

    /**
     * @param $id
     * @return Model
     */
    public function findPriorityByID($id): ?Model;

    /**
     * Delete model 
     * @param $modelId
     * @return bool.
     */
    public function deleteById(int $modelId): bool;
}
