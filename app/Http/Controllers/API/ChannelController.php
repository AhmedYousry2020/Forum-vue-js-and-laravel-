<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Channel;
use Validator;
use Illuminate\Validation\Rule;

use App\Http\Resources\ChannelResource;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ChannelResource::collection(Channel::all());


         // return response()->json([
         //     "error"=>"false",
         //     "data"=>Channel::all()
         // ]);

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
         "title"=>"required|unique:channels"
        ]);
        if($validator->fails()){

            return response()->json([
              "error"=>true,
              "errors"=>$validator->errors()
            ],422);
        }

        $channel = new Channel([
            "title" => $request->title
            ]);
        $channel->save();
        return new ChannelResource($channel);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return new ChannelResource($channel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $validator = Validator::make($request->all(),[
            "title"=>['required',Rule::unique('channels')->ignore($channel->id,'id')]
           ]);
           if($validator->fails()){

               return response()->json([
                 "error"=>true,
                 "errors"=>$validator->errors()
               ],422);
           }

           $channel->title = $request->title;
           $channel->save();
            return new ChannelResource($channel);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();
        return response()->json([
            "error" => false,
            "message" => "the channel with id: $channel->id successfully been deleted."
        ],200);

    }
}
