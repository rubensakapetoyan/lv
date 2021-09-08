<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Website;
use App\Models\Notice;

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

    public function getSubscribers($website) {
        $subscribes = $this->website->find($website)->subscribers;
        if($subscribes) {
            $arr = [];
            foreach($subscribes as $subscriber) {
                $arr[] = $subscriber;
            }
            return $arr;
        }

    }

    public function updatePost($id, $req) {

        $updateArray = [];
        if($req->title)
            $updateArray['title'] = $req->title;
        if($req->content)
            $updateArray['content'] = $req->content;
        if($req->website)
            $updateArray['website_id'] = $req->website;
        if($req->user)
            $updateArray['user_id'] = $req->user;

        $model = $this->post->where('id', $id)->update($updateArray);
        if($model)
            return true;

        return false;
    }

}
