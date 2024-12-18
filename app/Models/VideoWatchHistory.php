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
        // dd(session()->getId());

        $cacheKey = "user_{$userId}_video_{$videoId}_last_watch";
        
        // تحقق من وجود البيانات في التخزين المؤقت
        $lastWatchTime = Cache::get($cacheKey);

        if (!$lastWatchTime) {
            $lastWatch = self::where('user_id', $userId)
                              ->where('video_id', $videoId)
                              ->orderBy('watched_at', 'desc')
                              ->first();

            // احفظ نتيجة البحث في التخزين المؤقت لمدة 10 دقائق
            if ($lastWatch) {
                $lastWatchTime = $lastWatch->watched_at;
                Cache::put($cacheKey, $lastWatchTime, now()->addMinutes(10));
            }
        }

        if (!$lastWatchTime) {
            return true;
        }

        $now = Carbon::now();
        return $now->diffInMinutes($lastWatchTime) > 10;
    }
    use HasFactory;
}
