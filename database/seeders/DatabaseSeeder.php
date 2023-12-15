<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use DateTime;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
        for($i=1; $i < 5; $i++){

            DB::table('categories')->insert(
                ['name'=>"category1.1.{$i}",'parent_id'=>'8','created_at' => new DateTime,
            'updated_at' => new DateTime,]
            );
        }
        }
}