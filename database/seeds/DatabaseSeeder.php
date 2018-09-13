<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* 
        $items = [
            
            ['id' => 1, 'name' => 'Office Services' ,'description' => 'All The Office Services','photo' => null],
            ['id' => 2, 'name' => 'Tution  Services' ,'description' => 'All The Tution Services','photo' => null],
            ['id' => 3, 'name' => 'Beauty Services' ,'description' => 'All The Beauty Services','photo' => null],
           

        ];

        foreach ($items as $item) {
            \App\ProductCategory::create($item);
        }*/

        $itag = [
            
            ['id' => 1, 'name' => 'AC Repair' ,'pcid' => 1 ],
            ['id' => 2, 'name' => 'Computer Repair' ,'pcid' =>1],
            
        ];

        foreach ($itag as $item) {
            \App\ProductTag::create($item);
        }


        

    }
}
