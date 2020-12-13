<?php

use Illuminate\Database\Seeder;
use App\Channel;
class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = ['Python','PHP','c#', 'c++','JavaScript','HTML','CSS','Flutter'];
        foreach($channels as $channel){

            channel::create([
              'title'=>$channel
                ]);
        }

    }
}
