<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Website;
use App\Models\Notice;
use App\Jobs\SendSubscribtionEmail;

/**
 * Class PostsServices
 * @package App\Services
 */
class PostsServices {

    public $post;
    public $subscribe;
    public $user;
    public $website;
    public $notice;

    public function __construct(Post $post, Subscribe $subscribe, User $user, Website $website, Notice $notice) {
        $this->subscribe = $subscribe;
        $this->post = $post;
        $this->user = $user;
        $this->website = $website;
        $this->notice = $notice;
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

    public function setToJob() {
        $subscribes = $this->subscribe->getAllData()->groupBy('subscriber_id');
        if($subscribes) {
            $arr = [];
            foreach($subscribes as $subscriber) {
                $arr[] = $subscriber[0]->subscribers[0];//$subscriber->subscribers->map( function($item)  { return $item; });
//                $this->dispatch(new SendSubscribtionEmail($subscriber->email,'',''));
            }
            return $arr;
        }
    }
}
