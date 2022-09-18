<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert(
            [
                'title'=>'Tumba de Kazad Dun',
                'user_id'=> 3,
                'description'=>'Tumba del antiguo rey enano Balin',                
                'images'=>json_encode(['https:\/\/pbs.twimg.com\/media\/DaIquMnU8AIZ83p.jpg","https:\/\/powerups.es\/wp-content\/uploads\/2022\/06\/DCBD9289-2764-4093-8D80-BDC80C94CA4A-e1655027673305.jpeg']),
                'files'=>json_encode(['https:\/\/sketchfab.com\/models\/698ab634e0e54f82bbcf54a5392f75bc\/embed?autostart=1&camera=0']),
                'likes'=>rand(0,25),
                'views'=>rand(0,50),
                'tags'=>json_encode(['3D', '2D', 'Tumba de Kazad Dun', 'LOTR'])
            ]
        );

        DB::table('projects')->insert(
            [
                'title'=>'Abismo de Helm',
                'user_id'=> 3,
                'description'=>'TuAntigua Ultima fortaleza de rohan',                
                'images'=>json_encode(['https:\/\/static.wikia.nocookie.net\/eldragonverde\/images\/c\/c8\/Helm.jpg\/revision\/latest?cb=20120129171806&path-prefix=es']),
                'files'=>json_encode(['https:\/\/sketchfab.com\/models\/1eb25616c8a54ddf928ce6541cbd477b\/embed?autostart=1&camera=0']),
                'likes'=>rand(0,25),
                'views'=>rand(0,50),
                'tags'=>json_encode(['3D', '2D', 'Helms', 'LOTR'])
            ]
        );

        DB::table('projects')->insert(
            [                   
                'title'=>'Las cronicas de narnia',
                'description'=>'paisaje de las montañas by Anahit Takiryan', 
                'user_id'=> 11,               
                'images'=>json_encode(['https://i.pinimg.com/originals/f6/a5/65/f6a565389bbb3c6bb2e081daf293f9bb.jpg', 'https://mir-s3-cdn-cf.behance.net/project_modules/1400/3d601f78970787.5cb4e8b5ac19f.jpg']),
                'files'=>json_encode(['https://sketchfab.com/models/c283c87ee2164dd7a7e1bfb1c29898d4/embed?camera=0']),
                'likes'=>rand(0,25),
                'views'=>rand(0,50),
                'tags'=>json_encode(['3D', '2D', 'narnia'])
            ]
        );

        DB::table('projects')->insert(
            [
                'title'=>'rocas',
                'description'=>'rocas con escritura by britdawgmasterfunk', 
                'user_id'=> 10,               
                'images'=>json_encode(['https://i.ytimg.com/vi/Eh_EvGja0CY/maxresdefault.jpg']),
                'files'=>json_encode(['https://sketchfab.com/models/24490a645d044d45aa3c69606e3f2c6a/embed']),
                'likes'=>rand(0,25),
                'views'=>rand(0,50),
                'tags'=>json_encode(['3D', '2D', 'rocas'])
            ]
        );

        DB::table('projects')->insert(
            [
                'title'=>'Kendo',
                'description'=>'Luchadora de kendo by 小玉耀', 
                'user_id'=> 10,               
                'images'=>json_encode(['https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/4a0ffa13-8517-4205-b45f-0d5df1fd63f6/d5ama68-d704e6f4-db0b-45cd-a688-54460d66c43c.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzRhMGZmYTEzLTg1MTctNDIwNS1iNDVmLTBkNWRmMWZkNjNmNlwvZDVhbWE2OC1kNzA0ZTZmNC1kYjBiLTQ1Y2QtYTY4OC01NDQ2MGQ2NmM0M2MuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.07oVUCFYcAxYFseZYBIc1E4LjLiCLh62_fHg1apzJ7E']),
                'files'=>json_encode(['https://sketchfab.com/models/0390ef2adc5e4a4c9bd984abb2cda312/embed']),
                'likes'=>rand(0,25),
                'views'=>rand(0,50),
                'tags'=>json_encode(['3D', '2D', 'kendo'])
            ]
        );

        DB::table('projects')->insert(
            [
                'title'=>'Coche de carreras',
                'user_id'=> 3,
                'description'=>'Dodge Charger coche de carreras by 𝙎𝙍𝙏 𝙋𝙚𝙧𝙛𝙤𝙢𝙖𝙣𝙘𝙚™',                
                'images'=>json_encode(['https://i.pinimg.com/originals/f6/a5/65/f6a565389bbb3c6bb2e081daf293f9bb.jpg', 'https://mir-s3-cdn-cf.behance.net/project_modules/1400/3d601f78970787.5cb4e8b5ac19f.jpg']),
                'files'=>json_encode(['https://sketchfab.com/models/ecf78020f1c34d1085be4d8410f5ab40/embed']),
                'likes'=>rand(0,25),
                'views'=>rand(0,50),
                'tags'=>json_encode(['3D', '2D', 'carreras'])
            ]
        );
        
    }
}
