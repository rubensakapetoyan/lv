<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Validator;

class SubscribeService {

    public $post;
    public $subscribe;

    public function __construct(Post $post, Subscribe $subscribe) {
        $this->subscribe = $subscribe;
        $this->post = $post;
    }

    public function showAll() {
        return $this->subscribe->subscribers();
    }

    public function subscribe($req) {

        $validated = Validator::make($req->all(), [
            'website' => 'required|integer',
            'subscriber' => 'required|integer'
        ]);

        if(count($validated->errors())) {
            return response()->json([
                'status' => 'o',
                'errors' => $validated->errors()->all()
            ])->setStatusCode('503');
        }

        $exists = $this->subscribe->where('subscriber_id', $req->subscriber)->where('website_id', $req->website)->first();

        if($exists) {
            return response()->json([
                'status' => 'o',
                'errors' => ['This subscriber already subscribed on related website']
            ])->setStatusCode('503');
        }

        $stored = $this->subscribe::create([
            'subscriber_id' => $req->subscriber,
            'website_id' => $req->website
        ]);


        return response()->json([
            'status' => 'ok',
            'subscribed' => [
                'id' => $stored->id,
                'subscriber' => $stored->subscriber_id,
                'website' => $stored->website_id
            ]
        ])->setStatusCode('200');
    }

}
