<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teach;
use DB;

class teachController extends Controller
{

  public function newteachShow()
  {

    return view('home.newTeach');
  }

  public function newteach(Request $request)
  {
    $this->validate($request, [
        'title' => 'required',
        'benefits' => 'required',
        'summary' => 'required',
        'date' => 'required',
        'location' => 'required',
        'budget' => 'required|numeric',
    ]);
    DB::transaction(function() use ($request){

        $srcsArray = [];
        $namesArray = [];

        if($request->attachments){
          //first upload attachments if there are any
          foreach($request->attachments as $file){
              $attachsArray[] = basename($file->store( auth()->user()->id .'/gigs'));
          }
        }

        //save to DB

        Teach::create([
           'user_id' => auth()->user()->id,
           'title'   => $request->title,
           'benefits' => $request->benefits,
           'summary' => $request->summary,
           'attachments' => $attachsArray,
           'date' => $request->date,
           'location' => $request->location,
           'budget'  => $request->budget,
           'type'    => $request->type
        ]);
    });

    return redirect('/my-classes')->with('new-teach' , true);
  }

  public function teachEnroll(Request $request , $id)
  {

    $data = $request->data;
    $send = [];

    foreach ($data as $arr) {
      $send[$arr['name']] = $arr['value'];
    }

    $send['user_id'] = auth()->user()->id;

    // User::find($request->teach['owner_id'])->notify(new NotiBid(json_encode([
    //   'user_name' => auth()->user()->first_name,
    //   'gig_id'    => $id,
    //   'gig_title' => $request->gig['gig_title'],
    //   'budget'    => $send['budget']
    // ])));

    Teach::find($id)->enrolls()->create($send);
  }


  public function teachMore()
  {

    $teaches = Teach::with('enrolls')->orderBy('created_at' , 'DESC')->paginate(1);

   $teaches->map(function($teach){

     $teach->attachments = array_map(function($img) use ($teach){
                            return "media/{$teach->user_id}/gigs/{$img}";
                         },$teach->attachments);

     $teach->date = Carbon::now()->diffInDays(Carbon::parse($teach->date));

     $teach->has_enroll = $teach->enrolls->map(function($g){ if($g->user_id == auth()->user()->id) { return true; } })->first();

     return $teach;
   });


    return $teaches;
  }

  public function teachEdit(Request $request , $id)
  {

    $update = ['id' => $id];

    foreach ($request->data as $data) {
      if($data['name'] == 'benefits'){
        $update['benefits'][] = $data['value'];
      }else{
        $update[$data['name']] = $data['value'];
      }
    }

    Teach::find($id)->update([
       'title'   => $update['title'],
       'benefits' => $update['benefits'],
       'summary' => $update['summary'],
       'date' => $update['date']
    ]);

    return $update;
  }
  public function teachDelete($id)
  {


    Teach::find($id)->delete();
  }

}
