<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Subscribe;

class SubscribeService {

    public $post;
    public $subscribe;

    public function __construct(Post $post, Subscribe $subscribe) {
        $this->subscribe = $subscribe;
        $this->post = $post;
    }

    public function showAll() {
        return $this->subscribe->getSubscribers();
    }

}
