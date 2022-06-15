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

    public function update(EpisodeRequest $request, Episode $episode)
    {
        $episode->update($request->validated());

        $response['episode'] = new EpisodeResource($episode);

        return response()->success(__('strings.EPISODE_UPDATED'), $response, 200);
    }

    public function index()
    {
        $response['episode'] = EpisodeResource::collection(Episode::all());

        return response()->success(__('strings.EPISODES_RETRIEVED'), $response, 200);
    }

    public function show(Episode $episode)
    {
        $response['episode'] = new EpisodeResource($episode);

        return response()->success(__('strings.EPISODE_RETRIEVED'), $response, 200);
    }
}
