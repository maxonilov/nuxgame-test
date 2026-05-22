<?php

namespace App\Http\Controllers;

use App\Contracts\RegisterServiceInterface;
use App\Contracts\TokenServiceInterface;
use App\Http\Requests\PageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        private readonly TokenServiceInterface $tokenService,
        private readonly RegisterServiceInterface $userService,
    ) {}

    public function show(PageRequest $request): View
    {
        return view('page', [
            'user' => $request->getPageToken()->user,
        ]);
    }

    public function regenerate(PageRequest $request): RedirectResponse
    {
        return redirect()->route(
            'page.show',
            $this->tokenService->regenerate($request->getPageToken())->token
        );
    }

    public function deactivate(PageRequest $request): RedirectResponse
    {
        $this->userService->deactivate($request->getPageToken());

        return redirect()->route('register');
    }
}
