<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Conversation;
use App\Messages;
use Carbon\Carbon;

class adminController extends Controller
{

  public function showLogin()
  {

    return view('admin.login');
  }
  public function login(Request $request)
  {

    if(\Auth::attempt(['email' => $request->email ,
                     'password' => $request->password ,
                     'type' => 3]))
    {

      return redirect('/admin/stats');
    }

    return redirect()->back();
  }

  public function index()
  {
    $users = User::notAdmins()->paginate(10);


    $conversations = auth()->user()->conversations();

    $conversations = $conversations->map(function($conversation){

      $conversation->messages->map(function($msg){
        $msg->time =$msg->created_at->format('l h:i A');
      });

      return $conversation;
    });


    $users_calc = User::all();
    $count = $users_calc->count();

    $musicans = 0;
    $recuters = 0;

    foreach ($users_calc as $key => $user) {
      if($user->type == 1){
        $musicans += 1;
      }else if($user->type == 2){
        $recuters += 1;
      }
    }

    $musicans_percent = ($musicans / $count) * 100;
    $recuters_percent = ($recuters / $count) * 100;

    return view('admin.index' , compact('users' , 'conversations' , 'musicans_percent' , 'recuters_percent' , 'count'));
  }

  public function deleteUser(Request $request)
  {

    User::find($request->id)->delete();
  }
  public function deleteWarning(Request $request)
  {

    User::find($request->id)->update([
      'warning' => 0
    ]);
  }

  public function addToConversation($id)
  {
    $conversation_id = null;

    if(auth()->user()->id != $id){


      $conversation = Conversation::where([
        'user_id' => auth()->user()->id,
        'other_id'=> $id
      ])->get();

      if($conversation->isEmpty() &&  User::find($id)){
        $conversation_id = md5(rand(100 , 100000));

        Conversation::create([
          'conversation_id' => $conversation_id,
          'user_id' => auth()->user()->id,
          'other_id'=> $id
        ]);

        Conversation::create([
          'conversation_id' => $conversation_id,
          'other_id' => auth()->user()->id,
          'user_id'=> $id
        ]);

      }

      if(!$conversation->isEmpty()){
        $conversation_id = $conversation->first()->conversation_id;
      }

    }

    return Conversation::where('conversation_id' , $conversation_id)->first();
  }

  public function newMsg(Request $request)
  {

    Messages::create([
        'conversation_id' => $request->id,
        'user_id' => auth()->user()->id,
        'message' => $request->msg
     ]);

    return ['conversation_id' => $request->id,
            'user_id' => auth()->user()->id,
            'message' => $request->msg,
            'time'     => Carbon::now()->format('l h:i A')
           ];
  }

  public function moreUsers()
  {

    return User::notAdmins()->paginate(10);
  }
}
