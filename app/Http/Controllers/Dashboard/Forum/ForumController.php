<?php

namespace App\Http\Controllers\Dashboard\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Forum\ChangeForumCategoryRequest;
use App\Http\Requests\Dashboard\Forum\ChangeForumTypeRequest;
use App\Http\Requests\Dashboard\Forum\ForumStoreRequest;
use App\Http\Requests\Dashboard\Forum\ForumUpdateRequest;
use App\Http\Requests\Dashboard\Paginate\PaginateRequest;
use App\Http\Resources\Dashboard\Forum\CreateForumFormResource;
use App\Http\Resources\Dashboard\Forum\ForumDetailsResource;
use App\Http\Resources\Dashboard\Forum\ForumResource;
use App\Models\Forum;
use App\Services\AuthService;

class ForumController extends Controller
{


    protected function index(PaginateRequest $request)
    {
        $data = $request->validated();
        $forums = Forum::paginate($data['entriesOnPage'], ['*'], 'page', $data['page']);
        return ForumResource::collection($forums);
    }

    /**
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    protected function show(Forum $forum): \Illuminate\Http\JsonResponse
    {
        return response()->json(['forum' => new ForumDetailsResource($forum)]);
    }

    /**
     * @param ForumStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function store(ForumStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = AuthService::getAuthorizedUser($request);
        if ($data['type'] == 0 && $data['parentId'] != 0) {
            unset($data['parentId']);
        }
        $data['authorId'] = $user->id;
        $forum = Forum::firstOrCreate($data);
        return response()->json([
            'message' => 'Forum created!',
            'forum' => new ForumResource($forum),
        ]);
    }

    /**
     * @param ForumUpdateRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    protected function update(ForumUpdateRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        //dd($data, $forum);
        foreach ($data as $key => $value) {
            $forum->$key = $value;
        }
        $forum->save();
        return response()->json(['message' => 'Forum updated!']);

    }

    /**
     * @param ChangeForumCategoryRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    protected function changeParentForum(ChangeForumCategoryRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $parent = Forum::find($data['parentId']);
        $forum->parent()->associate($parent);
        $forum->save();
        return response()->json(['message' => 'Forum parent category changed!']);

    }

    /**
     * @param ChangeForumTypeRequest $request
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    protected function changeForumType(ChangeForumTypeRequest $request, Forum $forum): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if (count($forum->topics) !== 0 && $data['type'] == 0) {
            return response()->json(['message' => 'It is impossible to change the type of forum. There are topics on this forum.'], 413);
        }
        if ($forum->parentId !== null) {
            $forum->parentId = null;
        }
        $forum->type = $data['type'];
        $forum->save();
        return response()->json(['message' => 'Forum type changed! To make the forum appear on the site, select a parent forum for it.']);
    }

    /**
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    protected function delete(Forum $forum): \Illuminate\Http\JsonResponse
    {
//        if($forum->children){
//            foreach($forum->children as $child){
//                $child->parentId = $forum->parent->id ?? null;
//                $child->type = $child->parentId ? 1:0;
//                $child->save();
//            }
//        }
        if ($forum->children) {
            return response()->json(['message' => 'You cannot delete the forum. Move the child forums'], 413);
        }
        $forum->delete();
        return response()->json(['message' => 'Forum deleted successfully!']);
    }

    /**
     * @param Forum $forum
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Forum $forum): \Illuminate\Http\JsonResponse
    {
        $forum->status = !$forum->status;
        $forum->save();
        return response()->json(['message' => 'Forum status changed!']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function forumFormTree(): \Illuminate\Http\JsonResponse
    {
        $forums = Forum::all();
        return response()->json(['forums' => CreateForumFormResource::collection($forums)]);
    }

}
