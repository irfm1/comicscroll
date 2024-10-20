<?php
namespace App\Support\MediaLibrary\Downloaders;
use Spatie\MediaLibrary\Downloaders\Downloader;
class CustomDownloader implements Downloader
{
    public function getTempFile(string $url): string
    {
        $context = stream_context_create([
            'http' => [
                'timeout' => 100,
                'header' => "Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/130.0.6723.59 Safari/537.36",
            ],
        ]);
        $stream = file_get_contents($url, false, $context);
        $temporaryFile = tempnam(sys_get_temp_dir(), 'media-library');
        file_put_contents($temporaryFile, $stream);
        return $temporaryFile;
    }
}
