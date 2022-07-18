<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface KnowledgeRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

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
    public function update($modelId, array $attributes): bool;
    /**
     * Delete model 
     * @param $modelId
     * @return bool.
     */
    public function deleteById(int $modelId): bool;

    /**
     * @param $id
     * @return Model
     */
    public function findArticle($relations = [], $id): ?Model;
}
