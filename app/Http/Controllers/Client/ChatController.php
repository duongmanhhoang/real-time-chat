<?php

namespace App\Http\Controllers\Client;

use App\Events\Client\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ChatController extends Controller
{
    public function index()
    {
        if (Redis::exists('chat_log')) {
            $chat_logs = json_decode(Redis::get('chat_log'));
        } else {
            $chat_logs = null;
        }
        return view('client.chat', compact('chat_logs'));
    }

    public function submit(Request $request)
    {
        $data = [
            'message' => $request->message,
            'sent_by' => 'client',
        ];
        if (Redis::exists('chat_log')) {
            $log = Redis::get('chat_log');
            $arr_log = json_decode($log, true);
            array_push($arr_log, $data);
            Redis::getSet('chat_log', json_encode($arr_log));
        } else {
            $log = json_encode(array($data));
            Redis::set('chat_log', $log);
        }
        event(new Chat($data['message']));

        return response()->json(['message' => $data['message']], 200);
    }
}
