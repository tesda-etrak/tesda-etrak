<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Graduate;
use App\Models\JobVacancy;
use Carbon\Carbon;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViaGoogleSheetsController extends Controller
{
    protected $client;
    protected $service;

    public function index() {
        return view('via-google-sheets.index');
    }

    public function importGraduates() 
    {
        logger()->info('Initialising Google Sheets data import.');

        $client = new Client();
        $client->setAuthConfig(storage_path('app/private/credentials.json'));
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $service = new Sheets($client);

        $spreadsheetId = '100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q';
        // $spreadsheetId = '10LX-Ov_XGg984cGkGsAVoLF1S-CSfNz4DWhSaL44XJM';
        $sheet = 'List of Graduates';

        if (empty($spreadsheetId)) {
            logger()->error('Google Sheets data import failed: Spreadsheet ID is missing.');
            return 'Spreadsheet ID is not configured.';
        }

        $response = $service->spreadsheets_values->get($spreadsheetId, $sheet);
        $values = $response->getValues();
        logger()->info(count($values) . " rows found");

        if (empty($values)) {
            logger()->warning('Sheet is empty');
            return 'No data found';
        }

        // First row headers
        $headers = array_map('strtolower', $values[0]);
        $rows = array_slice($values, 1);

        // Chunk rows
        $chunks = array_chunk($rows, 1000);

        $chunkedRows = 0;
        $errorNum = 1;
        foreach ($chunks as $chunk) {
            logger()->info('Processing chunk...');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);

                $validator = Validator::make($data, [
                    'ln' => ['required', 'string', 'max:255'],
                    'fn' => ['required', 'string', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'email address' => ['nullable', 'string', 'max:255'],
                ]);

                if ($validator->fails()) {
                    logger()->warning("$errorNum. Skipping row due to validation: " . json_encode($data) . "\n");
                    $errorNum++;
                    continue;
                }

                $sanitized = [
                    'district' => trim($data['district'] ?? ''),
                    'city' => trim($data['city'] ?? ''),
                    'tvi' => trim($data['name of tvi'] ?? ''),
                    'qualification_title' => trim($data['qualification title'] ?? ''),
                    'sector' => trim($data['sector'] ?? ''),
                    'last_name' => trim($data['ln']),
                    'first_name' => trim($data['fn']),
                    'middle_name' => trim($data['mi'] ?? ''),
                    'extension_name' => trim($data['ext'] ?? ''),
                    'full_name' => trim($data['name']),
                    'sex' => trim($data['sex'] ?? ''),
                    'birthdate' => trim($data['date of birth'] ?? ''),
                    'contact_number' => trim($data['contact number'] ?? ''),
                    'email' => trim($data['email address'] ?? ''),
                    'address' => trim($data['address'] ?? ''),
                    'scholarship_type' => trim($data['scholarship type'] ?? ''),
                    'training_status' => trim($data['training status'] ?? ''),
                    'assessment_result' => trim($data['assessment result'] ?? ''),
                    'employment_before_training' => trim($data['employment before training'] ?? ''),
                    'occupation' => trim($data['occupation'] ?? ''),
                    'employer_name' => trim($data['name of employer'] ?? ''),
                    'employment_type' => trim($data['employment type'] ?? ''),
                    'employer_address' => trim($data['address of employer'] ?? ''),
                    'date_hired' => trim($data['date hired'] ?? ''),
                    'allocation' => trim($data['allocation'] ?? ''),
                    'verification_means' => trim($data['means of verification'] ?? ''),
                    'verification_date' => trim($data['date of verification'] ?? ''),
                    'verification_status' => trim($data['status of verification'] ?? ''),
                    'follow_up_date_1' => trim($data['follow-up date'] ?? ''),
                    'response_status' => trim($data['status of responses'] ?? ''),
                    'not_interested_reason' => trim($data['reasons (not interested)'] ?? ''),
                    'referral_status' => trim($data['referal status'] ?? ''),
                    'company_name' => trim($data['name of company'] ?? ''),
                    'company_address' => trim($data['address (city)'] ?? ''),
                    'job_title' => trim($data['job title'] ?? ''),
                    'employment_status' => trim($data['employment status'] ?? ''),
                    'hired_date' => trim($data['date of hired'] ?? ''),
                    'remarks' => trim($data['remarks'] ?? ''),
                    'count' => trim($data['count'] ?? ''),
                    'no_of_graduates' => trim($data['no. of graduates'] ?? ''),
                    'no_of_employed' => trim($data['no. of employed'] ?? ''),
                    'verification' => trim($data['verification'] ?? ''),
                    'job_vacancies' => trim($data['job vacancies (verification)'] ?? ''),
                    'follow_up_remarks' => trim($data['follow-up remarks'] ?? ''),
                    'application_status' => trim($data['application status (proceed or not for job opening)'] ?? ''),
                ];

                $sanitized['birthdate'] = $this->dateFormat1($sanitized['birthdate']);
                $sanitized['verification_date'] = $this->dateFormat1($sanitized['verification_date']);
                $sanitized['follow_up_date_1'] = $this->dateFormat1($sanitized['follow_up_date_1']);
                $sanitized['hired_date'] = $this->dateFormat2($sanitized['hired_date']);

                Graduate::create([
                    'district' => $sanitized['district'],
                    'city' => $sanitized['city'],
                    'tvi' => $sanitized['tvi'],
                    'qualification_title' => $sanitized['qualification_title'],
                    'sector' => $sanitized['sector'],
                    'last_name' => $sanitized['last_name'],
                    'first_name' => $sanitized['first_name'],
                    'middle_name' => $sanitized['middle_name'],
                    'extension_name' => $sanitized['extension_name'],
                    'full_name' => $sanitized['full_name'],
                    'sex' => $sanitized['sex'],
                    'birthdate' => $sanitized['birthdate'],
                    'contact_number' => $sanitized['contact_number'],
                    'email' => $sanitized['email'],
                    'address' => $sanitized['address'],
                    'scholarship_type' => $sanitized['scholarship_type'],
                    'training_status' => $sanitized['training_status'],
                    'assessment_result' => $sanitized['assessment_result'],
                    'employment_before_training' => $sanitized['employment_before_training'],
                    'occupation' => $sanitized['occupation'],
                    'employer_name' => $sanitized['employer_name'],
                    'employer_address' => $sanitized['employer_address'],
                    'employment_type' => $sanitized['employment_type'],
                    'date_hired' => $sanitized['date_hired'],
                    'allocation' => $sanitized['allocation'],
                    'verification_means' => $sanitized['verification_means'],
                    'verification_date' => $sanitized['verification_date'],
                    'verification_status' => $sanitized['verification_status'],
                    'follow_up_date_1' => $sanitized['follow_up_date_1'],
                    'follow_up_date_2' => null,
                    'follow_up_remarks' => $sanitized['follow_up_remarks'],
                    'response_status' => $sanitized['response_status'],
                    'not_interested_reason' => $sanitized['not_interested_reason'],
                    'referral_status' => $sanitized['referral_status'],
                    'referral_date' => null,
                    'no_referral_reason' => null,
                    'invalid_contact' => null,
                    'company_name' => $sanitized['company_name'],
                    'company_address' => $sanitized['company_address'],
                    'job_title' => $sanitized['job_title'],
                    'application_status' => $sanitized['application_status'],
                    'no_proceed_reason' => null,
                    'employment_status' => $sanitized['employment_status'],
                    'hired_date' => $sanitized['hired_date'],
                    'submitted_documents_date' => null,
                    'interview_date' => null,
                    'not_hired_reason' => null,
                    'remarks' => $sanitized['remarks'],
                    'count' => $sanitized['count'],
                    'no_of_graduates' => $sanitized['no_of_graduates'],
                    'no_of_employed' => $sanitized['no_of_employed'],
                    'verification' => $sanitized['verification'],
                    'job_vacancies' => $sanitized['job_vacancies'],
                ]);

                $chunkedRows++;
            }
        }

        $success_message = $chunkedRows . ' rows from Google Sheets imported successfully!';
        logger()->info($success_message);
        return redirect()->route('admin.table-of-graduates')->with('success', $success_message);
    }
    
    public function exportGraduates() 
    {
        logger()->info('Initialising local data export.');

        set_time_limit(600);

        $this->client = new Client();
        $this->client->setApplicationName('Laravel Google Sheets Export');
        $this->client->setAuthConfig(storage_path('app/private/credentials.json'));
        $this->client->setScopes(Sheets::SPREADSHEETS);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');
        $this->service = new Sheets($this->client);

        $spreadsheetId = '1-PlAbP1Y0dgqUEmblx3atGrjkkPWkOxrTE1qglkwfvM';
        $sheet = 'Sheet1!A2:BA100000000';

        // Clear old data
        $this->clearSheet($sheet, $spreadsheetId);

        // Add headers
        $headers = [[
            'District',
            'City',
            'Name of TVI',
            'Qualification Title',
            'Sector',
            'LN',
            'FN',
            'MI',
            'Ext',
            'Name',
            'Sex',
            'Date of Birth',
            'Contact Number',
            'Email Address',
            'Address',
            'Scholarship Type',
            'Training Status',
            'Assessment Result',
            'Employment Before Training',
            'Occupation',
            'Name of Employer',
            'Employment Type',
            'Address of Employer',
            'Date Hired',
            'Allocation',
            'Means of Verification',
            'Date of Verification',
            'Status of Verification',
            'First Follow-up Date',
            'Second Follow-up Date',
            'Follow-up Remarks',
            'Status of Responses',
            'Reasons (Not Interested)',
            'Referral Status',
            'Referral Date',
            'Reasons (No Referral)',
            'Invalid Contact',
            'Name of Company',
            'Address (City)',
            'Job Title',
            'Application Status (Proceed or Not for Job Opening)',
            'Reasons (Did Not Proceed for Job Opening)',
            'Employment Status',
            'Date of Hired',
            'Date of Submitted Documents',
            'Date of Interview',
            'Reasons (Not Hired)',
            'Remarks',
            'Count',
            'No. of Graduates',
            'No. of Employed',
            'Verification',
            'Job Vacancies (Verification)',
        ]];
        $this->updateRows('Sheet1!A1', $headers, $spreadsheetId);

        $data = [];
        Graduate::chunk(1000, function ($rows) use (&$data, $spreadsheetId) {
            foreach ($rows as $row) {
                $data[] = [
                    $row->district,
                    $row->city,
                    $row->tvi,
                    $row->qualification_title,
                    $row->sector,
                    $row->last_name,
                    $row->first_name,
                    $row->middle_name,
                    $row->extension_name,
                    $row->full_name,
                    $row->sex,
                    $row->birthdate,
                    $row->contact_number,
                    $row->email,
                    $row->address,
                    $row->scholarship_type,
                    $row->training_status,
                    $row->assessment_result,
                    $row->employment_before_training,
                    $row->occupation,
                    $row->employer_name,
                    $row->employer_address,
                    $row->employment_type,
                    $row->date_hired,
                    $row->allocation,
                    $row->verification_means,
                    $row->verification_date,
                    $row->verification_status,
                    $row->follow_up_date_1,
                    $row->follow_up_date_2,
                    $row->follow_up_remarks,
                    $row->response_status,
                    $row->not_interested_reason,
                    $row->referral_status,
                    $row->referral_date,
                    $row->no_referral_reason,
                    $row->invalid_contact,
                    $row->company_name,
                    $row->company_address,
                    $row->job_title,
                    $row->application_status,
                    $row->not_proceed_reason,
                    $row->employment_status,
                    $row->hired_date,
                    $row->submitted_documents_date,
                    $row->interview_date,
                    $row->not_hired_reason,
                    $row->remarks,
                    $row->count,
                    $row->no_of_graduates,
                    $row->no_of_employed,
                    $row->verification,
                    $row->job_vacancies,
                ];
            }
            
            sleep(1); // Prevent API quota issues
            
            logger()->info(count($data) . ' rows appended.');
        });

        $this->updateRows($sheet, $data, $spreadsheetId);
        
        logger()->info('Local data export complete.');
        return redirect()->route('via-google-sheets')->with('success', 'Local data export complete.');
    }

    public function importVacancies() 
    {
        logger()->info('Initialising Google Sheets data import.');

        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $service = new Sheets($client);

        $spreadsheetId = '100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q';
        $sheet = 'Job Vacancies';

        if (empty($spreadsheetId)) {
            logger()->error('Google Sheets data import failed: Spreadsheet ID is missing.');
            return 'Spreadsheet ID is not configured.';
        }

        $response = $service->spreadsheets_values->get($spreadsheetId, $sheet);
        $values = $response->getValues();
        logger()->info("Rows found: " . count($values));

        if (empty($values)) {
            logger()->warning('Sheet is empty');
            return 'No data found';
        }

        // First row headers
        $headers = array_map('strtolower', $values[0]);
        $rows = array_slice($values, 1);

        // Chunk rows
        $chunks = array_chunk($rows, 100);

        $errorNum = 1;
        foreach ($chunks as $chunk) {
            logger()->info('Processing chunk...');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);

                $validator = \Illuminate\Support\Facades\Validator::make($data, [
                    'name of company' => ['required', 'string', 'max:255'],
                ]);

                if ($validator->fails()) {
                    logger()->warning("$errorNum. Skipping row due to validation: " . json_encode($data) . "\n");
                    $errorNum++;
                    continue;
                }

                $sanitized = [
                    'request_date' => trim($data['date of request'] ?? ''),
                    'company_name' => trim($data['name of company']),
                    'city' => trim($data['city'] ?? ''),
                    'address' => trim($data['address'] ?? ''),
                    'contact_details' => trim($data['contact details'] ?? ''),
                    'sector' => trim($data['sector'] ?? ''),
                    'vacancies' => trim($data['vacancies'] ?? ''),
                    'related_qualifications' => trim($data['related qualifications'] ?? ''),
                    'job_titles' => trim($data['job titles (from tr)'] ?? ''),
                    'tr_qualifications' => trim($data['tr qualifications']),
                    'no_of_vacancies' => trim($data['no. of vacancies'] ?? ''),
                    'deployment_location' => trim($data['deployment location'] ?? ''),
                    'no_of_referred' => trim($data['no. of referred'] ?? ''),
                    'no_of_hired' => trim($data['no. of hired'] ?? ''),
                    'remarks' => trim($data['remarks'] ?? ''),
                    'attachment_link' => trim($data['attachment link'] ?? ''),
                ];

                $sanitized['request_date'] = $sanitized['request_date'] == '' ? null : $sanitized['request_date'];
                $sanitized['no_of_vacancies'] = $sanitized['no_of_vacancies'] == '' ? null : $sanitized['no_of_vacancies'];
                $sanitized['no_of_referred'] = $sanitized['no_of_referred'] == '' ? null : $sanitized['no_of_referred'];
                $sanitized['no_of_hired'] = $sanitized['no_of_hired'] == '' ? null : $sanitized['no_of_hired'];

                JobVacancy::create([
                    'request_date' => $sanitized['request_date'],
                    'company_name' => $sanitized['company_name'],
                    'city' => $sanitized['city'],
                    'address' => $sanitized['address'],
                    'contact_details' => $sanitized['contact_details'],
                    'sector' => $sanitized['sector'],
                    'vacancies' => $sanitized['vacancies'],
                    'related_qualifications' => $sanitized['related_qualifications'],
                    'job_titles' => $sanitized['job_titles'],
                    'tr_qualifications' => $sanitized['tr_qualifications'],
                    'no_of_vacancies' => $sanitized['no_of_vacancies'],
                    'deployment_location' => $sanitized['deployment_location'],
                    'no_of_referred' => $sanitized['no_of_referred'],
                    'no_of_hired' => $sanitized['no_of_hired'],
                    'remarks' => $sanitized['remarks'],
                    'attachment_link' => $sanitized['attachment_link'],
                ]);
            }
        }

        logger()->info('Google Sheets data import completed');
        return redirect()->route('admin.job-vacancies')->with('success', 'Google Sheets data import complete.');
    }

    public function importCompanies() 
    {
        logger()->info('Initialising Google Sheets data import.');

        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $service = new Sheets($client);

        $spreadsheetId = '100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q';
        $sheet = 'Job Vacancies!B1:F100000';

        if (empty($spreadsheetId)) {
            logger()->error('Google Sheets data import failed: Spreadsheet ID is missing.');
            return redirect()->route('via-google-sheets')->with('failed', 'Spreadsheet ID is not configured.');
        }

        $response = $service->spreadsheets_values->get($spreadsheetId, $sheet);
        $values = $response->getValues();
        logger()->info("Rows found: " . count($values));

        if (empty($values)) {
            logger()->warning('Sheet is empty');
            return redirect()->route('via-google-sheets')->with('failed', 'No data found.');
        }

        // First row headers
        $headers = array_map('strtolower', $values[0]);
        $rows = array_slice($values, 1);

        // Chunk rows
        $chunks = array_chunk($rows, 100);

        $errorNum = 1;
        foreach ($chunks as $chunk) {
            logger()->info('Processing chunk...');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);

                $validator = \Illuminate\Support\Facades\Validator::make($data, [
                    'name of company' => ['required', 'unique:companies,name', 'string', 'max:255'],
                    'city' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                ]);

                if ($validator->fails()) {
                    logger()->warning($errorNum . ". Skipping row due to validation: " . json_encode($data) . "\n");
                    $errorNum++;
                    continue;
                }

                $sanitized = [
                    'name' => trim($data['name of company']),
                    'city' => trim($data['city']),
                    'address' => trim($data['address']),
                    'contact_details' => trim($data['contact details']),
                    'sector' => trim($data['sector']),
                ];

                Company::create([
                    'name' => $sanitized['name'],
                    'city' => $sanitized['city'],
                    'address' => $sanitized['address'],
                    'contact_details' => $sanitized['contact_details'],
                    'sector' => $sanitized['sector'],
                ]);
            }
        }

        logger()->info('Google Sheets data import completed');
        return redirect()->route('via-google-sheets')->with('success', 'Google Sheets data import complete.');
    }

    public function updateRows($range, array $values, $spreadsheetId) 
    {
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
    }

    public function clearSheet($sheet, $spreadsheetId) {
        $this->service->spreadsheets_values->clear($spreadsheetId, $sheet, new Sheets\ClearValuesRequest());
    }

    // Format: 08/05/1930
    public function dateFormat1($date) 
    {
        $formattedDate = $date;

        if (strlen($date) == 10 && str_contains($date, '/')) {
            $date = Carbon::createFromFormat('m/d/Y', $date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }

    // Format: 05-Aug-1930
    public function dateFormat2($date) 
    {
        $formattedDate = $date;

        if (strlen($date) == 11 && str_contains($date, '-')) {
            $date = Carbon::parse($date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }

    // Format: 08-05-1930
    public function dateFormat3($date) 
    {
        $formattedDate = $date;

        if (strlen($date) == 10 && str_contains($date, '-')) {
            $date = Carbon::createFromFormat('m-d-Y', $date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }
}
