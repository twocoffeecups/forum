<?php

namespace App\Models\trait;

trait AdjacencyList
{

    public function descendantsTree(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(self::class, 'parentId', 'id')->with('descendantsTree');
    }

    public function allAncestors()
    {
        $ancestors = $this->where('id', '=', $this->parentId)->get();

        while ($ancestors->last() && $ancestors->last()->parentId !== null)
        {
            $parent = $this->where('id', '=', $ancestors->last()->parentId)->get();
            $ancestors = $ancestors->merge($parent);
        }

        return $ancestors;
    }

    public function allAncestorsAndMe()
    {
        $ancestors = $this->where('id', '=', $this->parentId)->get();

        while ($ancestors->last() && $ancestors->last()->parentId !== null)
        {
            $parent = $this->where('id', '=', $ancestors->last()->parentId)->get();
            $ancestors = $ancestors->merge($parent);
        }

        return $ancestors->merge($this);
    }

    /**
     * @param $forum
     * @return mixed
     */
    public static function allDescendants($forum): mixed
    {
        $descendants = $forum->children()->get();
        foreach($descendants as $descendant){
            $descendants = $descendants->merge($descendant->children()->get());
            if($descendant->children()->get()){
                $descendants = $descendants->merge(self::allDescendants($descendant));
            }
        }
        return $descendants;
    }

    /**
     * @param $forum
     * @return mixed
     */
    public static function allDescendantsAndMe($forum): mixed
    {
        $descendants = $forum->children()->get();
        foreach($descendants as $descendant){
            $descendants = $descendants->merge($descendant->children()->get());
            if($descendant->children()->get()){
                $descendants = $descendants->merge(self::allDescendants($descendant));
            }
        }
        return $descendants->prepend($forum);
    }

}
