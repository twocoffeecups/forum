<?php

namespace App\Http\Filters\Forum;

use App\Http\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TopicFilter extends Filter
{
    const ORDER_BY = 'orderBy';
    const TAGS = 'tags';
    //const FILTER_BY = 'filterBy';

    protected function getCallbacks(): array
    {
       return [
            self::TAGS => [$this, 'tags'],
            self::ORDER_BY => [$this, 'messageFilter'],
            //self::FILTER_BY => [$this, 'filterBy'],
       ];
    }

    protected function messageFilter(Builder $builder, $value)
    {
        $builder->with('posts')->orderBy('created_at', $value);
    }

    protected function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function($b) use($value) {
            $b->whereIn('tagId', $value);
        });
    }

    /** TODO: переделать */
//    protected function filterBy(Builder $builder, $value)
//    {
//        $builder->withCount($value)->orderBy(DB::raw("COUNT($value.topicId)"), 'desc');
//
//    }
}
