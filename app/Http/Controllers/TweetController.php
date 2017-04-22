<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Tweet;

class TweetController extends Controller
{
    public function update(Request $request, $tweetID)
    {
        $tweet = Tweet::find($tweetID);

//        dd($tweets);
        $validation = Validator::make($request->all()
            /*[
                'tweet' => request('tweet'),
            ]*/, [
                'tweet' => 'required|max:140',
            ]);

        if($validation->passes())
        {

            $tweet->tweet = request('tweet');
            $tweet->save();
//            DB::table('tweets')->insert([
//
//            ]);

            return redirect("/")
                ->with('successStatus', 'Tweet successfully updated!');
        } else{

            return redirect("/tweets/$tweetID/edit")
                ->withInput()
                ->withErrors($validation);
        }

    }
    public function edit($tweetID)
    {
        $tweets = Tweet::where('id', '=', $tweetID)->get();
        return view('tweets.edit', [
            'tweets' => $tweets
        ]);
    }

    public function viewID($tweetID)
    {
    //    return Tweet::find($tweetID);
     //   Tweet::with('tweet')->get();
        $tweets = Tweet::where('id', '=', $tweetID)->get();




     //   dd($tweets);
//   // $tweets = Tweet::find($tweetID);
//        $tweets = DB::table('tweets')
//            ->select('id', 'tweet')
//            ->where('id', '=', $tweetID)
//            ->get();


//
       return view('tweets.viewID', [
          'tweets' => $tweets
        ]);

    }

    public function destroy($tweetID)
    {

    $tweet = Tweet::find($tweetID);
    $tweet->delete();

//        DB::table('tweets')
//            ->where('id', '=', $tweetID)
//            ->delete();
        return redirect('/')
            ->with('successStatus', 'Tweet successfully deleted!');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all()
        /*[
            'tweet' => request('tweet'),
        ]*/, [
            'tweet' => 'required|max:140',
        ]);

        if($validation->passes())
        {
            $tweet = new Tweet();
              $tweet->tweet = request('tweet');
            $tweet->save();
//            DB::table('tweets')->insert([
//
//            ]);

            return redirect('/')

                ->with('successStatus', 'Tweet successfully created!');
        } else{

            return redirect('/')
                ->withInput()
                ->withErrors($validation);
        }


    }

    public function index()
    {
        $tweets = Tweet::orderBy('id','desc')->get();
//
   //     $tweets = DB::table('tweets')
//            ->select('id', 'tweet')
//            ->orderBy('id', 'desc')
//            ->get();


        return view('tweets.index', [
            'tweets' => $tweets
        ]);
    }
}
