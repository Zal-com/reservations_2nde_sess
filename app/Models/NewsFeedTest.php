<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class NewsFeedTest extends Model implements Feedable
{
    use CrudTrait;
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title,
            'summary' => $this->summary,
            'updated' => $this->updated_at,
            'link' => $this->link,
            'authorName' => $this->authorName,
        ]);
    }

    public static function getFeedItems()
    {
        return NewsFeedTest::all();
    }
}
