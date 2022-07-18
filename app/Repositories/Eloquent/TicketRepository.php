<?php


namespace App\Repositories\Eloquent;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\TicketRepositoryInterface;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Ticket $model
     */
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all($relations = []): Collection
    {
        return $this->model->with($relations)->get();
    }

    /**
     * @return Collection
     */
    public function loggedInUserRecords($relations = [], $loggedInId): Collection
    {
        return $this->model->with($relations)
            ->where('assigned_to_user_id', $loggedInId)
            ->get();
    }


    /**
     * @param $modelId
     * 
     * @return Model
     */
    public function findTicketByLoggedInUser($relations = [], $modelId)
    {
        return $this->model->with($relations)
            ->where('assigned_to_user_id', auth()->id())
            ->find($modelId);
    }

    /**
     * update Model by id
     * @param array $attributes
     *
     * @return bool
     */
    public function ticketUpdate($modelId, array $attributes): bool
    {
        return  $this->model->where('id', $modelId)->update($attributes);
    }


    /**
     * Delete model by model id
     * @param  $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->model->find($modelId)->delete();
    }
}
