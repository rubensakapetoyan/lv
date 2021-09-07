<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PostsServices;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public $postService;

    public function __construct(PostsServices $postService) {
        $this->postService = $postService;
    }

    public function createPost(Request $request) {

        /*$validated = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'website' => 'integer',
            'user' => 'integer'
        ]);*/
        /*implode(' , ', count($validated->errors()->all())
                    ? $validated->errors()->all() : [''])*/
        /*if(count($validated->errors())) {
            return response()->json([
                'status' => 'o',
                'errors' => $validated->errors()->all()

            ])->setStatusCode('503');
        }*/

//        $result = @$this->postService->create($request)->id;

        return $this->postService->setToJob(12);

        return response()->json([
            'status' => 'ok',
            'postId' => '12'//$result
        ])->setStatusCode('200');

    }

}
