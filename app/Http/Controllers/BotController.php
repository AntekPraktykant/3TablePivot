<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 02.02.2020
 * Time: 14:11
 */

namespace App\Http\Controllers;

//use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function index(Request $request)
    {
//        $client = new Client();
//        $method = 'POST';
//        $endPoint = '';
        $my_token = env('MESSENGER_TOKEN');
        $t = env('MESSENGER_TOKEN');
        $json = json_encode($request->all());
        $r = json_encode($request);
        $postImploded =  implode("; ", $_POST);
        $getImploded =  implode("; ", $_GET);
        $mode = $_GET['hub_mode'] ?? null;
        $challenge =$_GET['hub_challenge'] ?? null;
        $token = $_GET['hub_verify_token'] ?? null;
        return view('bot.bot', compact('request', 'token', 'challenge', 'mode', 'getImploded', 'json', 'r', 'postImploded', 't', 'my_token'));
    }

    public function index2()
    {
        $my_token = env('MESSENGER_TOKEN');
        $challenge = $_REQUEST['hub_challenge'] ?? null;
        $verify_token = $_REQUEST['hub_verify_token'] ?? null;
        // Set this Verify Token Value on your Facebook App
        if ($verify_token === $my_token) {
            echo $challenge;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        // Get the Senders Graph ID
        $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
        // Get the returned message
        $message = $input['entry'][0]['messaging'][0]['message']['text'];
        //$senderName = $input['entry'][0]['messaging'][0]['sender']['name'];

        $reply="Sorry, I don't understand you";

        switch($message)
        {
            case 'hello':
                $reply = "Hello, Greetings from MyApp.";
                break;
            case 'pricing':
                $reply = "Sample reply for pricing";
                break;
            case 'contact':
                $reply = "Sample reply for contact query";
                break;
            case 'webinar':
                $reply = "Sample reply for webinar";
                break;
            case 'support':
                $reply = "sample reply for support";
                break;
            default:
                $reply="Sorry, I don't understand you";
        }
        //API Url and Access Token, generate this token value on your Facebook App Page
        $url = "https://graph.facebook.com/v2.6/me/messages?access_token=$my_token";
        //Initiate cURL.
        $ch = curl_init($url);
        //The JSON data.
        $jsonData = '{
        "recipient":{
        "id":"' . $sender . '"
        },
        "message":{
            "text":"'.$reply.'"
            }
        }';
//Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//Execute the request but first check if the message is not empty.
        if (!empty($input['entry'][0]['messaging'][0]['message'])) {
            $result = curl_exec($ch);
        }

    }
}