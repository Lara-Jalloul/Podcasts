<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePodcastRequest;
use App\Http\Resources\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PodcastController extends Controller
{
    public function store(StorePodcastRequest $request)
    {
        $podcast_data = $request->validated();

        $podcast = Podcast::create($podcast_data);

        $response['podcast'] = PodcastResource::make($podcast);

        return response()->success(__('strings.PODCAST_STORED'), $response, 200);
    }

    public function delete($id)
    {
        Podcast::where('id', $id)->firstorfail()->delete();

        return response()->success(__('strings.PODCAST_DELETED'), [], 200);
    }
}
