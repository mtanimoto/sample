<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CarsSeeder extends Seeder
{
    public function run()
    {
        helper('text');
        $data = [
            [
                'id' => random_string('md5'),
                'type' => 'クラウン',
                'price' => 1000,
                'color' => 'ホワイト',
                'remark' => 'エレガントに決めたいならコレ！',
            ],
            [
                'id' => random_string('md5'),
                'type' => 'フェアレディZ',
                'price' => 800,
                'color' => 'シルバー',
                'remark' => 'スポーティーに日常を過ごしたいあなたへ！',
            ],
            [
                'id' => random_string('md5'),
                'type' => 'カローラ',
                'price' => 200,
                'color' => 'ブルー',
                'remark' => 'キムタクも乗っていた。（宣伝で）大切な人と乗りたい人は是非',
            ],
        ];

        $this->db->table('cars')->insertBatch($data);
    }
}
