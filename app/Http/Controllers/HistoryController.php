<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\LuckyHistory;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(PageRequest $request): View
    {
        return view('history', [
            'histories' => LuckyHistory::query()
                ->getLastByUser($request->getPageToken()->user_id)
                ->get(),
        ]);
    }
}
