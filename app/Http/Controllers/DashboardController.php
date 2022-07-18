<?php

namespace App\Http\Controllers;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use QueryTrait;

    /**
     * Show the application dashboard.
     *
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        try {
            $data = $this->ticketStatus();
            return view('admin.dashboard', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }
}
