<?php

use App\PlayProduct;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PlayProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlayProduct::truncate();

        $file = new \SplFileObject(database_path('csv/m_play_product.csv'));
        $file->setFlags(
            \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
        );

        foreach ($file as $i => $line) {
            if ($i === 0) {
                $headers = $line;
                continue;
            }

            $list = [];
            $now = Carbon::now();
            foreach ($file as $line) {
                $list[] = [
                    "inout" => $line[2],
                    "category" => $line[3],
                    "kanji_name" => $line[4],
                    "display_name" => $line[5],
                    "image_url" => $line[6],
                    "refe_link" => $line[7],
                    "youtube_video_Id" => $line[8],
                    "tool_tags" => $line[9],
                    "recommend_min_age" => (int) $line[10],
                    "recommend_max_age" => (int) $line[11],
                    "time_minutes" => (int) $line[12],
                    "description" => $line[13],

                    "created_at" => $now,
                    "updated_at" => $now,
                ];
            }

            DB::table("play_products")->insert($list);
        }
    }
}
