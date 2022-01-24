<?php 

namespace App\Models;

use DB\DB;

class Favorite
{
    public function save($data)
    {
        $db = new DB();
        $db->insert(
            'favorites',
            [
                'user_id' => $data['user_id'],
                'movie_id' => $data['movie_id']
            ]
        );

    }
}