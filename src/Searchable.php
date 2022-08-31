<?php

namespace TheAMasoud\LaravelSearch;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $builder, string $searchIn, string $input)
    {
        $builder->when(request()->has($input), function ($q) use ($searchIn, $input) {
            $q->where($searchIn, 'LIKE', '%'.request($input).'%');
        });
    }

    public function scopeJsonSearch(Builder $builder, string $searchIn, string $input)
    {
        $builder->when(request()->has($input), function ($q) use ($searchIn, $input) {
            // $q->whereJsonContains($searchIn, request($input));
            $q->where($searchIn, "LIKE", '%'.request($input).'%');
        });
    }

    public function scopeSearchMultiple(Builder $builder, $fields)
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
