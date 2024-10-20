<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Exception\GuzzleException;
use Exception;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class ComicScraperService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 60,
            'verify' => false // Desativa a verificação SSL. Use com cautela!
        ]);
    }

    public function scrapeChapters($url)
    {
        try {
            $response = $this->client->get($url);
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            $id = $crawler->filterXPath('//article')->attr('id');



            // list selector #chapterlist
            // numer xpath: //*[@id="chapterlist"]/ul/li[1]
            // title xpath: //*[@id="chapterlist"]/ul/li[1]/div/div/a/span[1]
            // url xpath: //*[@id="chapterlist"]/ul/li[1]/div/div/a
            $list = $crawler->filterXPath('//*[@id="chapterlist"]/ul/li')->each(function (Crawler $node) {
                return [
                    'number' => $this->extractChapterNumber($node->filterXPath('.//div/div/a/span[1]')->text()),
                    'title' => $node->filterXPath('.//div/div/a/span[1]')->text(),
                    'url' => $node->filterXPath('.//div/div/a')->attr('href')
                ];
            });

            return $list;

        } catch (GuzzleException $e) {
            \Log::error('Guzzle error scraping chapters: ' . $e->getMessage());
            throw new Exception('Failed to scrape chapters due to network error. Please try again later.');
        } catch (Exception $e) {
            \Log::error('Error scraping chapters: ' . $e->getMessage());
            throw new Exception('Failed to scrape chapters. Please try again later.');
        }
    }

    public function scrapePages($url)
    {
        try {
            $driver = RemoteWebDriver::create('http://localhost:59729', \Facebook\WebDriver\Remote\DesiredCapabilities::chrome());
            $driver->get($url);
            $html = $driver->getPageSource();
            $driver->quit();
            $crawler = new Crawler($html);

            $page_list = $crawler->filterXPath('//*[@id="readerarea"]//img')->each(function (Crawler $node) {
                return $node->attr('src');
            });


            return array_map(function ($image, $index) {
                return [
                    'number' => $index + 1,
                    'image' => $image
                ];
            }, $page_list, array_keys($page_list));



        } catch (GuzzleException $e) {
            \Log::error('Guzzle error scraping pages: ' . $e->getMessage());
            throw new Exception('Failed to scrape pages due to network error. Please try again later.');
        } catch (Exception $e) {
            \Log::error('Error scraping pages: ' . $e->getMessage());
            throw new Exception('Failed to scrape pages. Please try again later.');
        }
    }


    protected function extractChapterNumber($numberString)
    {
        preg_match('/\d+/', $numberString, $matches);
        return $matches[0] ?? 0;
    }


}
