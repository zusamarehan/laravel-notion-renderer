<?php

namespace RehanKanak\NotionAPIService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RehanKanak\Exceptions\NotionException;

class NotionPage
{
    /**
     * @throws NotionException
     */
    public function fetch($pageId): array
    {
        $url = "https://api.notion.com/v1/pages/$pageId";

        try {
            $client = new Client();

            $pages = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Notion-Version' => config('notion-renderer.NOTION_API_VERSION'),
                    'Authorization' => 'Bearer '.config('notion-renderer.NOTION_API'),
                ],
            ]);

            if ($pages->getStatusCode() == 200) {
                return [
                    'success' => true,
                    'data' => json_decode($pages->getBody(), true),
                ];
            }

            return [
                'success' => false,
                'details' => json_decode($pages->getBody(), true),
            ];
        } catch (GuzzleException $e) {
            throw new NotionException($e->getMessage(), $e->getCode());
        }
    }
}
