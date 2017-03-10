<?php

namespace App\Console\Commands;

use File;
use KrakenIO;
use Illuminate\Console\Command;

class Kraken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:kraken {filepath} {quality=80}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize an image';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $quality = intval($this->argument('quality'));

        $filePath = $this->argument('filepath');
        $fileName = $file = basename($filePath);

        if(!is_dir($filePath)) {

            $this->info('Searching for ' . $fileName);
            $this->info('Path: ' . $filePath);

            $this->kraken($filePath, $quality);

        } elseif(is_dir($filePath)) {

            $this->info("Kraking all files in {$filePath}");

            $files = File::files(substr($filePath, 0, -1));
            foreach($files as $file) {
                $this->kraken($file, $quality);
            }

        } else {
            $this->error('An error occured');
        }
    }

    /**
     * Compress a file using KrakenIO
     *
     * @param $filePath
     * @return bool
     */
    private function kraken($filePath, $quality) {

        $fileName = basename($filePath);

        if (!file_exists($filePath)) {
            $this->error('File not found: ' . $fileName);
            return false;
        }

        $this->info("\n"."Optimizing {$fileName}");

        $response = KrakenIO::upload([
            'file' => $filePath,
            'wait' => true,
            'lossy' => true,
            'quality' => $quality,
        ]);

        if ($response['success'] == true) {
            $contents = file_get_contents($response['kraked_url']);

            File::delete($filePath);
            File::put($filePath, $contents);

            $this->info('Kraked succesfully - original size: ' . $response['original_size'] . ' - New size: ' . $response['kraked_size']);
        } else {
            $this->error("Krake failed for this image");
        }
    }
}
