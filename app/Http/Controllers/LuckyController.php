<?php

namespace App\Http\Controllers;

use App\Contracts\LuckyServiceInterface;
use App\Http\Requests\PageRequest;
use Illuminate\View\View;

final class LuckyController extends Controller
{
    /**
     * @param LuckyServiceInterface $luckyService
     */
    public function __construct(private readonly LuckyServiceInterface $luckyService)
    {
    }

    /**
     * @param PageRequest $request
     * @return View
     */
    public function spin(PageRequest $request): View
    {
        return view('lucky', [
            'result' => $this->luckyService->spin($request->getPageToken()->user_id),
        ]);
    }
}
