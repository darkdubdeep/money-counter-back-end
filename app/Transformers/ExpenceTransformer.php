<?php

namespace App\Transformers;

use App\Expence;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class ExpenceTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(Expence $expence)
    {
        return [
            'id' => $expence->id,
            'author_id' => $expence->author_id,
            'title' => $expence->title,
            'date' => $expence->date,
            'slug' => $expence->slug,
            'body' => $expence->body,
            'summ' => $expence->summ,
            'comment' => $expence->comment
        ];
    }

    public function includeAuthor(Expence $expence) {
        return $this->item($expence->author, new UserTransformer);
    }
}
