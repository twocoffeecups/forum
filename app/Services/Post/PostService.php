<?php

namespace App\Services\Post;

use App\Http\Resources\Client\Post\PostResource;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\ReplyPost;

trait PostService
{

    /**
     * @param Topic $topic
     * @param User $user
     * @param array $data
     * @return mixed
     */
    protected function createPost(Topic $topic, User $user, array $data)
    {
        $data['userId'] = $user->id;
        $data['topicId'] = $topic->id;
        $post = Post::firstOrCreate($data);
        if(!empty($data['replyId'])){
            $this->sendReplyNotification($topic, $user, $post);
        }
        return $post;
    }

    /**
     * @param Post $post
     * @param array $data
     * @return Post
     */
    protected function updatePost(Post $post, array $data): Post
    {
        foreach ($data as $key => $value) {
            $post->$key = $value;
        }
        $post->save();
        return $post;
    }

    /**
     * @param Topic $topic
     * @param User $user
     * @param Post $post
     * @return void
     */
    protected function sendReplyNotification(Topic $topic, User $user, Post $post): void
    {
        $replyPost = Post::find($post->reolyId);
        $replyPost->author->notify(new ReplyPost($user, $post, $topic));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    protected function postCreatedSuccessfullyResponse(Post $post): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'The post updated.',
            'post' => new PostResource($post),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedToCreatePostResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Failed to create post.',
        ], 404);
    }

}
