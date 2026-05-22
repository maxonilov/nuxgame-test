<?php

namespace App\Http\Controllers;

use App\Contracts\RegisterServiceInterface;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(private readonly RegisterServiceInterface $register) {}

    public function show(): View
    {
        return view('register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        return redirect()->route(
            'page.show',
            $this->register->make($request->toDto())->token
        );
    }
}
