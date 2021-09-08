<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SubscribeService;

class SubscribeController extends Controller
{
    public $subscribe;

    public function __construct(SubscribeService $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * Subscribe
     * @param Request $request
     */
   public function store(Request $request)
   {
        return $this->subscribe->subscribe($request);
   }

}
