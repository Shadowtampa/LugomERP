<?php

namespace App\Http\Controllers\Twitter;

use App\Http\Controllers\Controller;
use App\Http\Services\Twitter\TwitterService;
use Illuminate\Http\Request;

class PublishCampaingController extends Controller
{
    public function __construct(protected TwitterService $twitterService) {
    }

    public function __invoke(Request $request){ 
        return $this->twitterService->publishCampaing($request);
    }
}
