<?php

namespace RehanKanak\LaravelNotionRenderer\NotionAPIService;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RehanKanak\LaravelNotionRenderer\Exceptions\NotionException;

class NotionDatabase
{
    /**
     * @throws NotionException
     */
    public function fetch($databaseId): array
    {
        $url = "https://api.notion.com/v1/databases/$databaseId/query";

        try {
            $client = new Client();

            $database = $client->request('POST', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Notion-Version' => config('notion-renderer.NOTION_API_VERSION'),
                    'Authorization' => "Bearer ".config('notion-renderer.NOTION_API'),
                ],
            ]);

            if ($database->getStatusCode() == 200) {
                return [
                    'success' => true,
                    'data' => json_decode($database->getBody(), true),
                ];
            }

            return [
                'success' => false,
                'details' => json_decode($database->getBody(), true),
            ];
        }
        catch (GuzzleException $e) {
            throw new NotionException($e->getMessage(), $e->getCode());
        }
    }
}
