<?php

namespace App\Http\Requests;

use App\Models\UserToken;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function getPageToken(): UserToken
    {
        return $this->attributes->get('page_token');
    }
}
