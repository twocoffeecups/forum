<?php

namespace App\Libraries;

class TreeBuilder
{
    /**
     * @param $nodes
     * @return mixed
     */
    public static function getTree($nodes)
    {
        return self::createTree($nodes);
    }

    /**
     * @param $nodes
     * @return mixed
     */
    protected static function createTree($nodes)
    {
        // get root nodes
        $parent = $nodes->where('parentId', 0);
        self::formatTree($parent, $nodes);
        return $parent;
    }

    /**
     * @param $parents
     * @param $nodes
     */
    protected static function formatTree($parents, $nodes)
    {
        foreach($parents as $parent){
            // add children nodes in parent
            $parent->children = $nodes->where('parentId', $parent->id)->values();
            // if children not null
            if($parent->children->isNotEmpty()){
                // recursively call the function
                self::formatTree($parent->children, $nodes);
            }
        }
    }
}
