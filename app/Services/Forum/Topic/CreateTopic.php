<?php

namespace App\Services\Forum\Topic;

use App\Events\CreatedNewTopic;
use App\Http\Resources\Forum\Topic\TopicResource;
use App\Models\Topic;
use App\Models\TopicImage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait CreateTopic
{

    protected function createTopic(User $user, $data){
        /** DB transaction
         */
        DB::beginTransaction();
        $topic = $this->storeTopic($user, $data);
        // tags
        if (!empty($data['tags'])) {
            $topic->tags()->toggle($data['tags']);
        }
        // images
        if (!empty($data['images'])) {
            $this->saveTopicImages($topic, $user, $data['images']);
        }
        $this->sendNotificationsToAdministrators($topic, $user);
        DB::commit();
        return $topic;
    }

    protected function storeTopic(User $user, array $data)
    {
        return Topic::create([
            'forumId' => $data['forumId'],
            'userId' => $user->id,
            'title' => $data['title'],
            'content' => $data['content'],
            'type' => $data['type'] ?? 0,
            'closeComments' => !empty($data['closeComments']) ? (int) $data['closeComments'] : 0,
            'status' => !empty($data['status']) ? (int) $data['status'] : 0,
        ]);
    }

    protected function sendNotificationsToAdministrators(Topic $topic, User $user)
    {
        event(new CreatedNewTopic($user, $topic));
    }

    protected function saveTopicImages(Topic $topic, User $user, $images)
    {
        foreach ($images as $image) {
            $imageName = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $imagePath = Storage::disk('public')->putFileAs('/topics/images', $image, $imageName);
            TopicImage::create([
                'topicId' => $topic->id,
                'userId' => $user->id,
                'imagePath' => $imagePath,
                'imageUrl' => url('/storage/' . $imagePath),
            ]);
        }
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function topicCreatedSuccessfullyResponse(Topic $topic): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'The topic created successfully.',
            'post' => new TopicResource($topic),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedToCreateTopicResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Failed to create topic.',
        ], 404);
    }

}
