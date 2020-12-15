<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = now()->subDay()->format("m_d_Y");
        $fileUrl = "http://files.tmdb.org/p/exports/movie_ids_{$date}.json.gz";
        $fileName = basename($fileUrl);
        $filePath = storage_path($fileName);
        file_put_contents($filePath, file_get_contents($fileUrl));

        $bufferSize = 4096;
        $outFileName = str_replace('.gz', '', $filePath);

        $file = gzopen($filePath, 'rb');
        $outFile = fopen($outFileName, 'wb');

        while (!gzeof($file)) {
            fwrite($outFile, gzread($file, $bufferSize));
        }

        fclose($outFile);
        gzclose($file);

        $fileContent = File::get($outFileName);
        $fileLines = explode(PHP_EOL, $fileContent);
        $movies = collect();
        foreach ($fileLines as $line) {
            if (empty($line)) {
                continue;
            }

            $movies->add(json_decode($line, true));
        }

        $chunks = $movies->filter()->chunk(10000);
        $chunks->each(function ($items) {
            Movie::insert($items->toArray());
        });

        unlink($outFileName);
        unlink($filePath);
    }
}
