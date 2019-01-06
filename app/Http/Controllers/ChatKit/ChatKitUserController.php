<?php

namespace App\Http\Controllers\ChatKit;

use Chatkit\Chatkit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatKitUserController extends Controller
{
    public $chatKit;

    public function __construct()
    {
        $this->chatKit = new Chatkit([
            'instance_locator' => 'v1:us1:663b8744-26ef-4713-9a95-6aac9c5329d1',
            'key' => '5f9f3b3c-7fc3-4cd2-a27b-10c28e318013:SnVSnR+MCYEfYqCISov0/eWu3qWT+l92AgCktAvj93k='
        ]);
    }

    public function getUsers(Request $request)
    {
        //throw new \Exception(($request['ids']));
        $users = $this->chatKit->getUsersByIds([ 'user_ids' => json_decode($request['ids'])]);

        return response()->json([
            'data' => $users['body']
        ], 200);
    }
}
