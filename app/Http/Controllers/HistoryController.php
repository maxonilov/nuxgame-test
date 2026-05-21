<?php

namespace App\Http\Controllers;

use App\Contracts\LuckyHistoryRepositoryInterface;
use App\Http\Requests\PageRequest;
use Illuminate\View\View;

final class HistoryController extends Controller
{
    /**
     * @param LuckyHistoryRepositoryInterface $historyRepository
     */
    public function __construct(private readonly LuckyHistoryRepositoryInterface $historyRepository)
    {
    }

    /**
     * @param PageRequest $request
     * @return View
     */
    public function index(PageRequest $request): View
    {
        return view('history', [
            'histories' => $this->historyRepository->getLastByUserId(
                $request->getPageToken()->user_id,
            ),
        ]);
    }
}
