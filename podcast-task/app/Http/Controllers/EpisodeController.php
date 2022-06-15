<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodeRequest;
use App\Http\Resources\EpisodeResource;
use App\Models\Episode;

class EpisodeController extends Controller
{
    public function store(EpisodeRequest $request)
    {
        $response['episode'] = new EpisodeResource(Episode::create($request->validated()));

        return response()->success(__('strings.EPISODE_STORED'), $response, 200);
    }

    public function delete(Episode $episode)
    {
        $episode->delete();

        return response()->success(__('strings.EPISODE_DELETED'), [], 200);
    }
}
