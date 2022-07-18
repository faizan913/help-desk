<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Service;
use App\Models\Priority;
use App\Models\Department;
use NunoMaduro\Collision\Adapters\Phpunit\State;

trait QueryTrait
{

    public function getService()
    {

        return Service::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    }
    public function getStatus()
    {
        return Status::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    }

    public function getPriority()
    {
        return  Priority::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    }

    public function getDepartment()
    {

        return Department::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    }

    public function getAllUserBelongsToTST()
    {
        return User::all()->where('department_id', 1)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
    }

    public function ticketStatus()
    {
        $statuses = Status::get();
        if (auth()->user()->hasRole('Admin')) {
            $data['totalTickets'] = Ticket::count();
            foreach ($statuses as $status) {
                $data[$status->name] = Ticket::whereHas(
                    'status',
                    function ($query) use ($status) {
                        $query->whereName($status->name);
                    }
                )->count();

                /*   $data['closedTickets'] = Ticket::whereHas('status', function ($query) {
                    $query->whereName('Closed');
                })->count(); */
            }
        } else {
            $data['totalTickets'] = Ticket::where('created_by', auth()->id())->orWhere('assigned_to_user_id', auth()->id())->count();
            foreach ($statuses as $status) {
                $data[$status->name] = Ticket::whereHas(
                    'status',
                    function ($query)  use ($status) {
                        $query->whereName($status->name);
                    }
                )->where('assigned_to_user_id', auth()->id())->count();
            }
            /*  $data['closedTickets'] = Ticket::whereHas('status', function ($query) {
                $query->whereName('Closed');
            })->where('created_by', auth()->id())
                ->where('assigned_to_user_id', auth()->id())
                ->count(); */
        }
        return $data;
    }

    public function getStatusCountBelongstoTickets($id)
    {
        return Status::whereId($id)
            ->withCount('tickets')
            ->having('tickets_count', '>', 0)
            ->get();
    }
    public function getServiceCountBelongstoTickets($id)
    {
        return Service::whereId($id)
            ->withCount('tickets')
            ->having('tickets_count', '>', 0)
            ->get();
    }
    public function getPriorityCountBelongstoTickets($id)
    {
        return Priority::whereId($id)
            ->withCount('tickets')
            ->having('tickets_count', '>', 0)
            ->get();
    }

    public function getDepartmentCountBelongstoUsers($id)
    {
        return Department::whereId($id)
            ->withCount('users')
            ->having('users_count', '>', 0)
            ->get();
    }
}
