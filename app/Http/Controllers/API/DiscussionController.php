<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\DiscussionResource;
use App\Discussion;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DiscussionResource::collection(Discussion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            "title"=>"required|unique:discussions",
            "content"=>"required"
           ]);
           if($validator->fails()){

               return response()->json([
                 "error"=>true,
                 "errors"=>$validator->errors()
               ],422);
           }
           $discussion =  new Discussion([
              "title"=>$request->title,
              "content"=>$request->content,
              "slug"=>Str::of($request->title)->slug('-'),
              "user_id"=>$request->user_id,
              "channel_id"=>$request->channel_id

           ]);
           $discussion->save();
           return new DiscussionResource($discussion);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
       $discussion = Discussion::where("slug",$slug)->firstOrFail();

        return new DiscussionResource($discussion);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              $discussion = Discussion::find($id);
        $validator = Validator::make($request->all(),[
            "title"=>'required',
            "content"=>"required"
           ]);
           if($validator->fails()){

               return response()->json([
                 "error"=>true,
                 "errors"=>$validator->errors()
               ],422);
           }

           $discussion->title = $request->title;
           $discussion->content = $request->content;
           $discussion->slug = Str::of($request->title)->slug('-');
           $discussion->user_id = $request->user_id;
           $discussion->channel_id = $request->channel_id;
           $discussion->save();
            return new DiscussionResource($discussion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return response()->json([
            "error" => false,
            "message" => "the channel with id: $discussion->id successfully been deleted."
        ],200);
    }
}
