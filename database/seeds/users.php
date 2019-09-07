<?php

use Illuminate\Database\Seeder;
Use App\User;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');      
        
       
        DB::table('users')->insert([
            'first_name' => 'Sebahattin',
            'last_name' => 'Erzincan',
            'username' => 'Robocop',
            'zipcode' => rand(1, 9999),
            'streetname' => 'Street '.rand(1, 999),
            'housenumber' => rand(1, 999),
            'housenumbersuffix' => rand(1, 5),
            'relation' => '1',
            'image' => 'default.jpg',
            'email' => '341089@talnet.nl',
            'password' => bcrypt('123456789'),                                             
        ]);

        $firstNameCollection = array("Harry","Ross",
                        "Bruce","Cook",
                        "Carolyn","Morgan",
                        "Albert","Walker",
                        "Randy","Reed",
                        "Larry","Barnes",
                        "Lois","Wilson",
                        "Jesse","Campbell",
                        "Ernest","Rogers",
                        "Theresa","Patterson",
                        "Henry","Simmons",
                        "Michelle","Perry",
                        "Frank","Butler",
                        "Shirley");

        $lastNameCollection = array("Ruth","Jackson",
                        "Debra","Allen",
                        "Gerald","Harris",
                        "Raymond","Carter",
                        "Jacqueline","Torres",
                        "Joseph","Nelson",
                        "Carlos","Sanchez",
                        "Ralph","Clark",
                        "Jean","Alexander",
                        "Stephen","Roberts",
                        "Eric","Long",
                        "Amanda","Scott",
                        "Teresa","Diaz",
                        "Wanda","Thomas");
       
        for ($i=0; $i < 30; $i++) 
        {
            DB::table('users')->insert([
                'first_name' => $firstNameCollection[rand(0, count($firstNameCollection)-1)],
                'last_name' => $lastNameCollection[rand(0, count($lastNameCollection)-1)],
                'username' => 'Robocop'.rand(1, 99999999999999),
                'zipcode' => rand(1, 9999),
                'streetname' => 'Street'.rand(1, 999),
                'housenumber' => rand(1, 999),
                'housenumbersuffix' => rand(1, 5),
                'relation' => rand(1, 7),
                'image' => 'default.jpg',
                'email' => '341089'.rand(1, 99999999999999).'@talnet.nl',
                'password' => bcrypt('123456789'),                                             
            ]);
        }
    }
}

