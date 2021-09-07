<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendSubscribtionEmail;
use Illuminate\Http\Request;
use App\Services\PostsServices;
use Illuminate\Support\Facades\Validator;
use App\Models\Notice;
use App\Models\Post;

class PostsController extends Controller
{
    public $postService;
    public $post;
    public $notice;

    public function __construct(PostsServices $postService, Post $post, Notice $notice) {
        $this->postService = $postService;
        $this->post = $post;
        $this->notice = $notice;
    }

    public function createPost(Request $request) {

        $validated = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'website' => 'integer',
            'user' => 'integer'
        ]);
        /*implode(' , ', count($validated->errors()->all())
                    ? $validated->errors()->all() : [''])*/
        if(count($validated->errors())) {
            return response()->json([
                'status' => 'o',
                'errors' => $validated->errors()->all()
            ])->setStatusCode('503');
        }

        $result = @$this->postService->create($request);

        if($result) {
            $arr = $this->postService->setToJob();
            foreach($arr as $s) { 
                if(!$this->notice->where('noticer', $s->email)->get()) {
                    $this->notice::create([
                       'noticer' =>  $s->email
                    ]);
                }
                if(!$this->notice->where('noticer', $s->email)->get()->noticed) {
                    $this->dispatch(new SendSubscribtionEmail($s->email, $result->title, $result->content));
                    $this->notice::create([
                        'noticed' =>  $s->email
                    ]);
                }
            }
        }

        return response()->json([
            'status' => 'ok',
            'postId' => @$result->id
        ])->setStatusCode('200');

    }

}
