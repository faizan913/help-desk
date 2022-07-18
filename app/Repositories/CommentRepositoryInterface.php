<?php


namespace App\Repositories;

use App\Model\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
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
     * @param $id
     * @return Model
     */
    public function loggedInUserRecords($relations = [], $loggedInId): Collection;


    /**
     * Update existing model
     * @param array $attributes
     * @return bool
     */
    public function commentUpdate($modelId, array $attributes): bool;
    /**
     * Delete model 
     * @param $modelId
     * @return bool.
     */
    public function deleteById(int $modelId): bool;
}
