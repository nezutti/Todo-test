<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'tagName'=>"家事"
        ];
        Tag::create($param);

        $param=[
            'tagName'=>"勉強"
        ];
        Tag::create($param);
        
        $param=[
            'tagName'=>"運動"
        ];
        Tag::create($param);
        
        $param=[
            'tagName'=>"食事"
        ];
        Tag::create($param);

        $param=[
            'tagName'=>"移動"
        ];
        Tag::create($param);

     
       
}

}
