<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->spreadsheetId = '1-PlAbP1Y0dgqUEmblx3atGrjkkPWkOxrTE1qglkwfvM';

        $this->client = new Client();
        $this->client->setApplicationName('Laravel Google Sheets Export');
        $this->client->setAuthConfig(storage_path('app/credentials.json'));
        $this->client->setScopes(Sheets::SPREADSHEETS);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');

        $this->service = new Sheets($this->client);
    }

    public function updateRows($range, array $values) 
    {
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->update($this->spreadsheetId, $range, $body, $params);
    }

    public function appendRows($spreadsheetId, $range, array $values) 
    {
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW',
            'insertDataOption' => 'INSERT_ROWS',
        ];

        return $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    }

    public function clearSheet($sheet) {
        $this->service->spreadsheets_values->clear($this->spreadsheetId, $sheet, new Sheets\ClearValuesRequest());
    }
}
