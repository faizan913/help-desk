<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{


    /**
     * Show the application comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        try {
            if (auth()->user()->hasRole('Admin')) {
                $reports = User::with('tickets')->get();
            } else {
                $reports = User::with('tickets')->whereId(auth()->id())->get();
            }
            return view('admin.report.index', compact('reports'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }
}
