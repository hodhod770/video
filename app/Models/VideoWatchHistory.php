<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class VideoWatchHistory extends Model
{
    protected $fillable = ['user_id', 'video_id', 'watched_at'];
    public static function canRecordWatch($userId, $videoId)
    {
        $cacheKey = "user_{$userId}_video_{$videoId}_last_watch";
        
        // تحقق من وجود البيانات في التخزين المؤقت
        $lastWatch = Cache::get($cacheKey);
        if (!$lastWatch) {
            $lastWatch = self::where('user_id', $userId)
                              ->where('video_id', $videoId)
                              ->orderBy('watched_at', 'desc')
                              ->first();

            // احفظ نتيجة البحث في التخزين المؤقت لمدة 10 دقائق
            if ($lastWatch) {
                Cache::put($cacheKey, $lastWatch->watched_at, now()->addMinutes(10));
            }
        }

        if (!$lastWatch) {
            return true;
        }
        // dd($lastWatch);

        $now = Carbon::now();
        return $now->diffInMinutes($lastWatch->watched_at) > 10;
    }
    use HasFactory;
}
