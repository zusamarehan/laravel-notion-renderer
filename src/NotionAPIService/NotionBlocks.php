<?php

namespace RehanKanak\LaravelNotionRenderer\NotionAPIService;

use GuzzleHttp\Exception\GuzzleException;
use RehanKanak\LaravelNotionRenderer\Exceptions\NotionException;
use GuzzleHttp\Client;

class NotionBlocks
{
    /**
     * Notion API: https://developers.notion.com/reference/get-block-children
     *
     * @throws NotionException
     */
    public function fetch($id): array
    {
        $url = "https://api.notion.com/v1/blocks/$id/children";

        try {
            $client = new Client();

            $blocks = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Notion-Version' => config('notion-renderer.NOTION_API_VERSION'),
                    'Authorization' => "Bearer ".config('notion-renderer.NOTION_API'),
                ],
            ]);

            if ($blocks->getStatusCode() == 200) {
                return [
                    'success' => true,
                    'data' => json_decode($blocks->getBody(), true)['results'],
                ];
            }

            return [
                'success' => false,
                'details' => json_decode($blocks->getBody(), true),
            ];
        }
        catch (GuzzleException $e) {
            throw new NotionException($e->getMessage(), $e->getCode());
        }
    }
}
