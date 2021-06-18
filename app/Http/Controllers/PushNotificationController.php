<?php

namespace App\Http\Controllers;

use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $push_notifications = PushNotification::orderBy('created_at', 'desc')->get();
        return view('notification.index', compact('push_notifications'));
    }

    // public function bulksend_(Request $req){
    //     $comment = new PushNotification();
    //     $comment->title = $req->input('title');
    //     $comment->body = $req->input('body');
    //     $comment->img = $req->input('img');
    //     $comment->save();
    //     $url = 'https://fcm.googleapis.com/fcm/send';
    //     $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $req->id,'status'=>"done");
    //     $notification = array('title' =>$req->title, 'text' => $req->body, 'image'=> $req->img, 'sound' => 'default', 'badge' => '1',);
    //     $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
    //     $fields = json_encode ($arrayToSend);
    //     $headers = array (
    //         'Authorization: key=' . "AAAAHrk3CV4:APA91bFur9J1gQdLC3L3Hz1lpI8BjmoSPiRj-kZt6UNg3__ejYYd8aDaPL_NMWptwKWHFye8MHTpW3jBSCTwvYBdPHksRSeFo4vZbocsyAnlOeBsUSESR_rOH3xq4_VGKkNt4i0n-rIz",
    //         'Content-Type: application/json'
    //     );
    //     $ch = curl_init ();
    //     curl_setopt ( $ch, CURLOPT_URL, $url );
    //     curl_setopt ( $ch, CURLOPT_POST, true );
    //     curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    //     curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    //     curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
    //     $result = curl_exec ( $ch );
    //     var_dump($fields);
    //     // curl_close ( $ch );
    //     // return redirect()->back()->with('success', 'Notification Send successfully');
    // }

    public function bulksend(Request $req){

        $SERVER_API_KEY = 'AAAAHrk3CV4:APA91bFur9J1gQdLC3L3Hz1lpI8BjmoSPiRj-kZt6UNg3__ejYYd8aDaPL_NMWptwKWHFye8MHTpW3jBSCTwvYBdPHksRSeFo4vZbocsyAnlOeBsUSESR_rOH3xq4_VGKkNt4i0n-rIz';
  
        $data = [
            "registration_ids" => ["ddd8SIuCSAea02Ub55qWTh:APA91bHTPPX0BPvQesEZKuS6VTIzHgBMrb3p-t1d8qGKpDe8ITlXL0OqYCnttUsBtxnbJ5Eoq25TQLxBpsU8WjLKC2hjwkYXrb2f_3Ih3fnQ1rk6GJPMbTP1I0f2EgFgbhhhLOyc0B3h"],
            "notification" => [
                "title" => $req->title,
                "body" => $req->body,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        dd($response);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notification.create');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}
