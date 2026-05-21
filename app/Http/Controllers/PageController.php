<?php

namespace App\Http\Controllers;

use App\Contracts\RegisterServiceInterface;
use App\Contracts\TokenServiceInterface;
use App\Http\Requests\PageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * @param TokenServiceInterface $tokenService
     * @param RegisterServiceInterface $userService
     */
    public function __construct(
        private readonly TokenServiceInterface $tokenService,
        private readonly RegisterServiceInterface $userService,
    ) {
    }

    /**
     * @param PageRequest $request
     * @return View
     */
    public function show(PageRequest $request): View
    {
        return view('page', [
            'user' => $request->getPageToken()->user,
        ]);
    }

    /**
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function regenerate(PageRequest $request): RedirectResponse
    {
        return redirect()->route(
            'page.show',
            $this->tokenService->regenerate($request->getPageToken())->token
        );
    }

    /**
     * @param PageRequest $request
     * @return RedirectResponse
     */
    public function deactivate(PageRequest $request): RedirectResponse
    {
        $this->userService->deactivate($request->getPageToken());

        return redirect()->route('register');
    }
}
