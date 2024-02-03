<?php

namespace App\Services\Forum\Topic;

use App\Http\Resources\Client\Topic\TopicResource;
use App\Models\Topic;
use App\Models\TopicImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait UpdateTopic
{
    /**
     * @var Topic
     */
    protected Topic $topic;

    /**
     * @param Topic $topic
     * @param $data
     * @return Topic
     */
    protected function updateTopic(Topic $topic, $data): Topic
    {
        $this->topic = $topic;
        /** DB transaction */
        DB::beginTransaction();
        $topic = $this->update($topic, $data);
        /** Tags */
        !empty($data['tags'])
            ? $topic->tags()->toggle($data['tags'])
            : $topic->tags()->detach();
        /** Images */
        $this->changeTopicImages($topic, $data);
        DB::commit();
        /** End transaction */
        return $topic;
    }

    /**
     * @param Topic $topic
     * @param $data
     * @return Topic
     */
    protected function update(Topic $topic, array $data): Topic
    {
        $topic->fill([
            'forumId' => $data['forumId'],
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
        $topic->save();
        return $topic;
    }

    /**
     * @param Topic $topic
     * @param $data
     * @return void
     */
    protected function changeTopicImages(Topic $topic, array $data): void
    {
        // delete old images
        if (!empty($topic->images) && !empty($data['imagesForDelete'])) {
            $this->deleteOldImages($topic, $data['imagesForDelete']);
        }
        // save new images
        if (!empty($data['images'])) {
            $this->saveImages($data['images']);
        }
    }

    /**
     * @param Topic $topic
     * @param $imagesForDelete
     * @return void
     */
    protected function deleteOldImages(Topic $topic, $imagesForDelete)
    {
        foreach ($topic->images as $image) {
            if (in_array($image->id, $imagesForDelete)) {
                Storage::disk('public')->delete($image->imagePath);
                $image->delete();
            }
        }
    }

    /**
     * @param $images
     * @return void
     */
    protected function saveImages($images): void
    {
        //dd($images);
        foreach ($images as $image) {
            $imageName = md5(Carbon::now() . '_' . $image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            $imagePath = Storage::disk('public')->putFileAs('/topics/images', $image, $imageName);
            TopicImage::create([
                'topicId' => $this->topic->id,
                'userId' => $this->topic->userId,
                'imagePath' => $imagePath,
                'imageUrl' => url('/storage/' . $imagePath),
            ]);
        }
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\JsonResponse
     */
    protected function topicUpdatedSuccessfullyResponse(Topic $topic): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'The topic update successfully.',
            'topic' => new TopicResource($topic),
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedToUpdateTopicResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Failed to update topic.',
        ], 404);
    }

}
