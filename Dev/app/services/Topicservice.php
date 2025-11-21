<?php

namespace App\Services;

use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicService
{

    public function create(int $threadId, array $data): Topic
    {
        return Topic::create([
            'thread_id' => $threadId,
            'title' => $data['title'],
            'body' => $data['body'],
            'user_id' => Auth::id(),
        ]);
    }


    public function update(Topic $topic, array $data): bool
    {
        return $topic->update($data);
    }


    public function delete(Topic $topic): bool
    {
        return $topic->delete();
    }

    
    public function canEdit(Topic $topic): bool
    {
        return Auth::id() === $topic->user_id || Auth::user()->isAdmin();
    }
}
