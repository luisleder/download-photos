<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DownloadPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download photos from jsonplaceholder.typicode.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd("descargar");
    }
}
