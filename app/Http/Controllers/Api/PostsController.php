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

    public function __construct(PostsServices $postService, Post $post, Notice $notice)
    {
        $this->postService = $postService;
        $this->post = $post;
        $this->notice = $notice;
    }

    public function showPerWebsite(Request $request) {
        $id =  $id = $request->route('id');
        $posts = $this->post->where('website_id', $id)->get();
        return response()->json([
            'status' => 'ok',
            'posts' => $posts
        ])->setStatusCode('200');
    }

    public function showAll() {
        return response()->json([
            'status' => 'ok',
            'posts' => $this->post->get()
        ])->setStatusCode('200');
    }

    public function createPost(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'website' => 'required|integer',
            'user' => 'required|integer'
        ]);
        /*implode(' , ', count($validated->errors()->all())
                    ? $validated->errors()->all() : [''])*/
        if (count($validated->errors())) {
            return response()->json([
                'status' => 'o',
                'errors' => $validated->errors()->all()
            ])->setStatusCode('503');
        }

        $result = @$this->postService->create($request);

        $success = false;
        if ($result) {
            $arr = $this->postService->getSubscribers($result->website_id);
            foreach($arr as $index => $s) {
                $n = $this->notice->where('noticer', $s->email)->get();
                if (count($n) == 0 || $n[0]->noticer !== $s->email) {
                    $this->notice::create([
                       'noticer' =>  $s->email
                    ]);
                }

                if (!$n[0]->noticed) {
                    $this->dispatch(new SendSubscribtionEmail($s->email, $result->title, $result->content));
                    $this->notice->where('noticer', $s->email)->update([
                        'noticed' =>  1
                    ]);
                    $success = true;
                }
            }
        }

        $inQueue = "Has no subscribers on related website, or it's maybe subscriber already been noticed.";
        if (count($arr) && $success)
            $inQueue = 'Notice successfully set to queue for sending as email.';

        return response()->json([
            'status' => 'ok',
            'postId' => @$result->id,
            'notice'  => $inQueue
        ])->setStatusCode('200');

    }

    public function update(Request $request) {
        $validated = Validator::make($request->all(), [
            'title' => 'unique:posts|max:255',
            'content' => 'required',
            'website' => 'integer',
            'user' => 'integer'
        ]);

        if (count($validated->errors())) {
            return response()->json([
                'status' => 'o',
                'errors' => $validated->errors()->all()
            ])->setStatusCode('503');
        }

        $id = $request->route('id');

        $updated = $this->postService->updatePost($id, $request);

        if($updated) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Successfully updated.'
            ])->setStatusCode('200');
        }

        return response()->json([
            'status' => 'o',
            'message' =>  "Can't update. Maybe can't find post with current id"
        ])->setStatusCode('503');
    }


    public function destroy(Request $request) {
        $id = $request->route('id');
        $model = $this->post->find($id);
        $removed = null;
        if(!is_null($model)) {
            $removed = $model->delete();
        }
        if($removed) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Successfully removed.'
            ])->setStatusCode('200');
        }

        return response()->json([
            'status' => 'o',
            'message' =>  "Can't remove. Maybe can't find post with current id"
        ])->setStatusCode('503');
    }

}
