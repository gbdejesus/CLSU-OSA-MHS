<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Events\NewMessage;
use App\Image as UserImage;
use App\User;
use App\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * @param $id
     * @return JsonResponse
     */
    public function getContactList($id): JsonResponse
    {
        $user = User::where('id', '=', $id)->first();
        $contacts = User::where('id', '!=', $id);

        if ($user->role === 'COUNSELOR') {
            $contacts = User::whereIn('id', json_decode($user->clients))->get();
        } else if ($user->role === 'CLIENT') {
            $contacts = User::whereIn('id', json_decode($user->counselors))->get();
        } else {
            $contacts = User::where('id', '!=', $id)->get();
        }

        $unreadIds = Message::select(DB::raw(' `from` as sender_id, count(`from`) as messages_count'))
            ->where('to', $id)
            ->where('read', false)
            ->groupBy('from')
            ->get();

        $contacts = $contacts->map(function ($contact) use ($contacts, $unreadIds, $user) {

            // just to compatible to plugin <vue-advanced-chat>
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unreadCount = $contactUnread ? $contactUnread->messages_count : 0;
            $contact->roomId = $contact->id;
            $contact->roomName = $contact->name;
            $contact->evaluation_details = json_decode($contact->evaluation_details);
            $contact->avatar = $contact->profile_image ?? $this->getUserImage($contact->id);
            $lastMessage = $this->getLastMessage($contact->id, $user->id);
            $contact->lastMessageTime = false;
            if ($lastMessage) {
                $contact->lastMessage = $this->formatMessage($lastMessage->toArray(), $contact->name);
                $contact->lastMessage->content = $this->trimLastMessage($contact->lastMessage->content, 30);
                $contact->lastMessageTime = $lastMessage->created_at;
            }

            $contact->index = $contact->lastMessageTime;

            $users = [];
            if ($contact->role === 'COUNSELOR') {
                $usersArray = json_decode($contact->clients);
            } else if ($contact->role === 'CLIENT') {
                $usersArray = json_decode($contact->counselors);
            }

            if (isset($usersArray) AND count($usersArray) >= 1) {
                $contact->users = $this->getUsers($usersArray);
            }

            return $contact;
        });

        return response()->json($contacts);
    }

    public function getLastMessage($from, $to)
    {
        return Message::where('from', $from)->where('to', $to)->latest()->first();
    }

    /**
     * @param $text
     * @param $maxChar
     * @param string $end
     * @return string
     */
    public function trimLastMessage($text, $maxChar, string $end = '...'): string
    {
        if (strlen($text) > $maxChar || $text == '') {
            $words = preg_split('/\s/', $text);
            $output = '';
            $i = 0;
            while (1) {
                $length = strlen($output) + strlen($words[$i]);
                if ($length > $maxChar) {
                    break;
                } else {
                    $output .= " " . $words[$i];
                    ++$i;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }
        return $output;
    }

    public function formatMessage($message, $username)
    {
        $msg = [];
        $msg['_id'] = $message['id'];
        $msg['content'] = $message['text'];
        $msg['senderId'] = $message['from'];
//        $msg['username'] = $username;
        $msg['timestamp'] = date('h:i a', strtotime($message['created_at']));
        $msg['saved'] = true;
        $msg['distributed'] = false;
        $msg['seen'] = $message['read'];
        $msg['new'] = 1;

        return (object) $msg;
    }

    /**
     * @param $usersArray
     * @return array
     */
    public function getUsers($usersArray)
    {
        $users = [];
        foreach ($usersArray as $user) {
            $userDetails = User::findOrFail($user);

            $prepare = [];
            $prepare['_id'] = $userDetails->id;
            $prepare['username'] = $userDetails->name;
            $prepare['image'] = $this->getUserImage($userDetails->id);
            $users[] = $prepare;
        }

        return $users;
    }

    public function getMessages($id, $auth_id)
    {
        $sender = User::where('id', '=', $id)->first();
        $receiver = User::where('id', '=', $auth_id)->first();

        Message::where('from', $id)->where('to', $auth_id)->update(['read' => true]);
        $messages = Message::where('from', '=', $id)->orWhere('to', '=', $id)->get();

        $newMessages = [];
        foreach ($messages as $msg) {
            if ($msg->from == $auth_id or $msg->to == $auth_id) {
                $msg->_id = $msg->id;
                $msg->content = $msg->text;
                $msg->senderId = (string) $msg->from;
                $msg->timestamp = $msg->created_at->format('M j, Y    h:i A');
                $msg->username = $sender->name;
                $msg->avatar = $sender->profile_image;
                $msg->seen = $msg->read;
                if ($msg->from == $auth_id) {
                    $msg->username = $receiver->name;
                    $msg->avatar = $receiver->profile_image ?? $this->getUserImage($receiver->id);
                }

                $newMessages[] = $msg;
            }
        }

        return response()->json($newMessages);
    }

    public function sendNewMessage(Request $request)
    {
        $message = Message::create([
            'from' => $request->sender_id,
            'to' => $request->receiver_id,
            'text' => $request->text['content'] ?? $request->text['text'],
            'senderId' => $request->sender_id,
            'content' => $request->text['content'] ?? $request->text['text'],
        ]);

        // just to compatible to plugin <vue-advanced-chat>
        $message->_id = $message->id;
        $message->content = $message->text;
        $message->senderId = $message->from;
        $message->timestamp = $message->created_at->format('H:i:s A');

        $toBroadcast = $message;
        $toBroadcast->_id = $message->id;
        $toBroadcast->content = $message->text;
        $toBroadcast->senderId = (string) $message->from;
        $toBroadcast->timestamp = $message->created_at->format('H:i:s A');

        broadcast(new NewMessage($message));
        return response()->json($toBroadcast);
    }

    public function getCounselors()
    {
        $counselors = User::where('role', '=', 'COUNSELOR')->get()->toArray();

        foreach ($counselors as $key => $value) {
            $image = UserImage::where('profileId', $value['id'])->first();
            if (! is_null($image)) {
                $counselors[$key]['image'] = $image['content'];
            }
        }

        return response()->json($counselors);
    }

    /**
     * @param $counselorId
     * @param $userId
     * @return JsonResponse
     */
    public function selectCounselor($counselorId, $userId)
    {
        $counselor = User::findOrFail($counselorId);
        if ($counselor->role !== 'COUNSELOR') {
            return response()->json(['success' => false, 'message' => 'Invalid Counselor is selected.']);
        }

        if (!is_null($counselor->clients)) {
            $counselors = json_decode($counselor->clients);
            $counselors[] = $userId;
            $counselor->clients = json_encode($counselors);
        } else {
            $counselor->clients = ["$userId"];
        }
        $counselor->save();

        $profile = User::findOrFail($userId);
        if ($profile->role !== 'CLIENT') {
            return response()->json(['success' => false, 'message' => 'User is not a CLIENT.']);
        }

        if (!is_null($profile->counselors)) {
            $counselors = json_decode($profile->counselors);
            $counselors[] = $counselorId;
            $profile->counselors = json_encode($counselors);
        } else {
            $profile->counselors = ["$counselorId"];
        }

        $profile->save();

        $this->sendInitialMessage($userId, $counselorId);

        return response()->json(['success' => true, 'message' => 'Success!','response' => $profile]);
    }

    private function sendInitialMessage($userId, $counselorId): void
    {
        $messageContent = "AUTO REPLY: Thank you for reaching out to Office of Student Affairs - CLSU. Our reply hours is from 8:00 AM to 5:00 PM, Monday to Friday. We'll get back to you as soon as possible.";
        $message = Message::create([
            'from' => $counselorId,
            'to' => $userId,
            'text' => $messageContent,
            'senderId' => $counselorId,
            'content' => $messageContent,
        ]);

        // just to compatible to plugin <vue-advanced-chat>
        $message->_id = $message->id;
        $message->content = $message->text;
        $message->senderId = $message->from;
        $message->timestamp = $message->created_at->format('H:i:s');

        $toBroadcast = $message;
        $toBroadcast->_id = $message->id;
        $toBroadcast->content = $message->text;
        $toBroadcast->senderId = (string) $message->from;
        $toBroadcast->timestamp = $message->created_at->format('H:i:s');

        broadcast(new NewMessage($message));
    }

    private function getUserImage($id)
    {
        $image = UserImage::where('profileId', $id)->first();
        if (! is_null($image)) {
            return $image['content'];
        }
    }
}
