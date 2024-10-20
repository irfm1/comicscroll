<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;
use App\Services\ComicScraperService;


class CrawllerController extends Controller
{
    public function getComic(Request $request)
    {
        try {
            $url = $request->url;

            $client = new Client();
            $response = $client->request('GET', $url);
            $body = $response->getBody()->getContents();
            $crawler = new Crawler($body);

            //id xpath /html/body/div[2]/div[2]/div/div[2]/article
            $id = $crawler->filterXPath('//article')->attr('id');

            $image = $crawler->filterXPath('//*[@id="' . $id . '"]//img')->attr('src');
            $title = $crawler->filterXPath('//*[@id="titlemove"]/h1')->text();
            $alt = $crawler->filterXPath('//*[@id="titlemove"]/span')->text();
            $description = $crawler->filterXPath('//*[@id="' . $id . '"]/div[1]/div[2]/div[1]/div[3]/div/p/span/span')->text();
            $status = $crawler->filterXPath('//*[@id="' . $id . '"]/div[1]/div[1]/div/div[6]/div[1]/i')->text();
            $type = $crawler->filterXPath('//*[@id="' . $id . '"]/div[1]/div[1]/div/div[6]/div[2]/a')->text();


            $data = [
                'title' => $title,
                'alt' => $alt,
                'description' => $description,
                'image' => $image,
                'status' => $status,
                'type' => $type,
                'user_id' => $request->user_id,
                'url' => $url
            ];



            // post to api to save comic
            $client = new Client();
            $response = $client->request('POST', 'http://comicscroll.test/api/comics', [
                'json' => $data
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('dashboard')->with('success', 'Comic cadastrado com sucesso');
            } else {
                return response()->json(['message' => 'Erro ao cadastrar comic'])->setStatusCode(500);
            }

        } catch (\Exception $e) {
            $message = $e->getMessage();

            return response()->json(['message' => $message])->setStatusCode(500);
        }


    }

}
