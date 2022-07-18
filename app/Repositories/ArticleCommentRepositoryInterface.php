<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface ArticleCommentRepositoryInterface
{

    /**
     * @param $id
     * @return Model
     */
    public function all($relations = []): Collection;


    /**
     * Delete model 
     * @param $modelId
     * @return bool.
     */
    public function deleteById(int $modelId): bool;
}
