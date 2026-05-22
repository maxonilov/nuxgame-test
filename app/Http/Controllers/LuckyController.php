<?php

namespace App\Http\Controllers;

use App\Contracts\LuckyServiceInterface;
use App\Http\Requests\PageRequest;
use Illuminate\View\View;

class LuckyController extends Controller
{
    public function __construct(private readonly LuckyServiceInterface $luckyService) {}

    public function spin(PageRequest $request): View
    {
        return view('lucky', [
            'result' => $this->luckyService->spin($request->getPageToken()->user_id),
        ]);
    }
}
