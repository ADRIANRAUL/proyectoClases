<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = factory(Post::class, 200)->make()->toArray();
        DB::table('posts')->insert($records);


       /* $records=array(
            array('name'=>'Publicacion 1', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 2', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 3', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 4', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 5', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 6', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 7', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 8', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 9', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 10', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 11', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 12', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 13', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 14', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 1', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 2', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 3', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 4', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 5', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 6', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 7', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 8', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 9', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 10', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 11', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 12', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 13', 'content'=>'Contenido de la publicacion 1'),
            array('name'=>'Publicacion 14', 'content'=>'Contenido de la publicacion 1'),
        );

        DB::table('posts')->insert($records);*/
    }
}
