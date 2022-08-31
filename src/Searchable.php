<?php

namespace TheAMasoud\LaravelSearch;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * search in one column by your database column and your request key
     * @usage Model::search('title','search')->get();
     * @param Builder $builder
     * @param string $searchIn
     * @param string $input
     */
    public function scopeSearch(Builder $builder, string $searchIn, string $input)
    {
        $builder->when(request()->has($input), function ($q) use ($searchIn, $input) {
            $q->where($searchIn, 'LIKE', '%'.request($input).'%');
        });
    }

    /**
     * search in json column by your database column and your request key
     * @usage Model::jsonSearch('title->key','search')->get();
     * @param Builder $builder
     * @param string $searchIn
     * @param string $input
     */
    public function scopeJsonSearch(Builder $builder, string $searchIn, string $input)
    {
        $builder->when(request()->has($input), function ($q) use ($searchIn, $input) {
            // $q->whereJsonContains($searchIn, request($input));
            $q->where($searchIn, "LIKE", '%'.request($input).'%');
        });
    }

    /**
     * search in multiple columns by your database column and your request key but them in array
     * @usage Model::searchMultiple(['name'=>'search_name','email'=>'search_email'])->get();
     * @param Builder $builder
     * @param array $fields
     */
    public function scopeSearchMultiple(Builder $builder,array $fields)
    {
        $builder->where(function ($q) use ($fields) {
            foreach ($fields as $key => $field) {
                if (!request()->has($field)) {
                    continue;
                }
                $q->orWhere($key, "LIKE", "%".request($field)."%");
            }
        });
    }

    /**
     * search in multiple columns by with one value
     * @usage Model::searchInMultiple(['name','email','bio'],'search')->get();
     * @param Builder $builder
     * @param array $searchIn
     * @param string $input
     */
    public function scopeSearchInMultiple(Builder $builder, array $searchIn, string $input)
    {
        $builder->when(request()->has($input), function ($q) use ($searchIn, $input) {
            $q->where(function ($q) use ($searchIn, $input) {
                foreach ($searchIn as $field) {
                    $q->orWhere($field, 'LIKE', '%'.request($input).'%');
                }
            });
        });
    }
}
