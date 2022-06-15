<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use App\Http\Resources\EpisodeResource;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function store(EpisodeRequest $request)
    {
        $response['episode'] = new EpisodeResource(Episode::create($request->validated()));

        return response()->success(__('strings.EPISODE_STORED'), $response, 200);
    }
}
