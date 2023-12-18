<?php

namespace App\Console\Commands;

use App\Models\Photo;
use App\Services\JSONPlaceholder;
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
        if($data = JSONPlaceholder::getData())
        {
            foreach ($data as $item) {

                Photo::firstOrCreate([
                    'reference' => $item["id"],
                    ],[
                    'albumn' => $item["albumId"],
                    'title' => $item["title"],
                    'url' => $item["url"],
                    'thumb' => $item["thumbnailUrl"],
                ]);
          
            }
            
        }
    }
}
