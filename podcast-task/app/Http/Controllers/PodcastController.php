<?php

namespace App\Http\Controllers;

use App\Http\Requests\PodcastRequest;
use App\Http\Resources\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function store(PodcastRequest $request)
    {
        $response['podcast'] = new PodcastResource(Podcast::create($request->validated()));

        return response()->success(__('strings.PODCAST_STORED'), $response, 200);
    }

    public function delete(Podcast $podcast)
    {
        $podcast->delete();

        return response()->success(__('strings.PODCAST_DELETED'), [], 200);
    }

    public function update(PodcastRequest $request, Podcast $podcast)
    {
        $podcast->update($request->validated());

        $response['podcast'] = new PodcastResource($podcast);

        return response()->success(__('strings.PODCAST_UPDATED'), $response, 200);
    }

    public function index(Request $request)
    {
        $podcasts = Podcast::offset($request->offset ?? 0)->limit($request->limit ?? 10)->get();

        $response['podcasts'] = PodcastResource::collection($podcasts);

        return response()->success(__('strings.PODCASTS_RETRIEVED'), $response, 200);
    }

    public function show(Podcast $podcast)
    {
        $response['podcast'] = new PodcastResource($podcast);

        return response()->success(__('strings.PODCAST_RETRIEVED'), $response, 200);
    }
}
