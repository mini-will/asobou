<?php

use App\PlayProduct;
use Illuminate\Database\Seeder;

class PlayProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject('database/csv/m_play_product.csv');
        $file->setFlags(
            \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
        );
        $list = [];
        $now = Carbon::now();
        foreach ($file as $line) {
            $list[] = [
                "label" => $line[0],
                "name" => $line[1],
                "created_at" => $now,
                "updated_at" => $now,
            ];
        }

        DB::table("m_play_product")->insert($list);
    }
}
