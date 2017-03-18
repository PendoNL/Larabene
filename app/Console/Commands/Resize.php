<?php

namespace App\Console\Commands;

use File;
use Image;
use Illuminate\Console\Command;

class Resize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:resize 
                            {filepath : path to an image or folder of images to proces}
                            {--destination=null : Optional - destination path to save the image(s) to}
                            {--prefix=null : Optional - prefix for resized images}
                            {--width=null : Optional - desired with to be resized to} 
                            {--height=null : Optional - desired height to be resized to} 
                            {--quality=80 : Optional - quality of the image}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize an image or a folder of images';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filePath = $this->argument('filepath');
        $fileName = $file = basename($filePath);

        $prefix = ($this->option('prefix') != 'null') ? $this->option('prefix') : null;
        $quality = (intval($this->option('quality')) == 0) ? 80 : intval($this->option('quality'));
        $width = ($this->option('width') == 'null' || intval($this->option('width')) == 0) ? null : intval($this->option('width'));
        $height = ($this->option('height') == 'null' || intval($this->option('height')) == 0) ? null : intval($this->option('height'));

        if ($width == null && $height == null) {
            $this->error('Not both width and height can be null');

            return false;
        }

        if ($this->option('destination') != 'null' && !is_dir($this->option('destination'))) {
            $this->error('Invalid destination folder');

            return false;
        }

        $destinationPath = (is_dir($filePath)) ? (is_dir($this->option('destination')) ? $this->option('destination') : $filePath) : (is_dir($this->option('destination')) ? $this->option('destination') : dirname($filePath));

        if ($destinationPath == dirname($filePath) && $prefix == null) {
            $this->error('When saving to the same directory, please specify a file prefix');

            return false;
        }

        if (!is_dir($filePath)) {
            $this->info('Searching for '.$fileName);
            $this->info('Path: '.$filePath);

            $this->resize($filePath, $destinationPath, $prefix, $width, $height, $quality);
        } elseif (is_dir($filePath)) {
            $this->info("Resizing all files in {$filePath} and saving to {$destinationPath}");

            $files = File::files(substr($filePath, 0, -1));
            foreach ($files as $file) {
                $this->resize($file, $destinationPath, $prefix, $width, $height, $quality);
            }
        } else {
            $this->error('An error occured');
        }
    }

    /**
     * Resize the file(s).
     *
     * @param $filePath
     * @param $destination
     * @param $prefix
     * @param $width
     * @param $height
     * @param $quality
     *
     * @return bool
     */
    private function resize($filePath, $destination, $prefix, $width, $height, $quality)
    {
        $fileName = basename($filePath);

        if (!file_exists($filePath)) {
            $this->error('File not found: '.$fileName);

            return false;
        }

        $this->info("Resizing {$fileName}");

        $image = Image::make($filePath);
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($destination.'/'.$prefix.$fileName, $quality);
    }
}
