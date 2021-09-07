<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Subscribe;
use App\Jobs\SendSubscribtionEmail;


class PostsServices {

    public $post;
    public $subscribe;

    public function __construct(Post $post, Subscribe $subscribe) {
        $this->subscribe = $subscribe;
        $this->post = $post;
    }

    public function create($req) {

        $created = $this->post::create([
            'title' => $req->title,
            'content' => $req->content,
            'website_id' => $req->website,
            'user_id' => $req->user,
        ]);

        return $created;

    }

    public function setToJob($id) {
        $subscribes = $this->subscribe->with('subscribers');
        dd($subscribes);
//        if($subscribes) {
//            foreach( $subscribes as $subscriber) {
////                $this->dispatch(new SendSubscribtionEmail($subscriber->email,,''));
//            }
//        }
    }
}
