<?php

use Illuminate\Database\Seeder;
use App\Relation;
class relations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Relation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');      
        
       
        DB::table('relations')->insert([
            'description' => 'Single',                                            
        ]);
        DB::table('relations')->insert([
            'description' => 'It’s Complicated',                                            
        ]);
        DB::table('relations')->insert([
            'description' => 'In a Relationship',                                            
        ]);
        DB::table('relations')->insert([
            'description' => 'Engaged',                                            
        ]);
        DB::table('relations')->insert([
            'description' => 'Married',                                            
        ]);
        DB::table('relations')->insert([
            'description' => 'In a Domestic Partnership',                                            
        ]);
        DB::table('relations')->insert([
            'description' => 'Divorced / Separated',                                            
        ]);
    }
}
