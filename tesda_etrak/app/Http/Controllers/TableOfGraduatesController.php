<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class TableOfGraduatesController extends Controller
{
    public function index(Request $request) {
        $graduates = Graduate::select('id', 'last_name', 'first_name', 'middle_name', 'extension_name', 'employment_status', 'allocation', 'qualification_title')
        ->orderBy('id', 'desc')->paginate(10);
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('table-of-graduates.index', compact('graduates', 'search', 'search_category'));
    }

    public function search_graduates(Request $request) 
    {
        $graduates = null;
        $search = null;
        $search_category = null;

        if (empty($request)) {
            $graduates = Graduate::select()->orderBy('id', 'desc')->paginate(10);
            return view('table-of-graduates.index', compact('graduates', 'search', 'search_category'));
        }

        $search = $request->input('search');
        $search_category = $request->input('search_category');

        switch ($search_category) {
            case "Record number":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Full Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('full_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Last Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('last_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "First Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Middle Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('middle_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Extension Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('extension_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Status of Employment":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('employment_status', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Year of Graduation":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('allocation', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Qualification Title":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('qualification_title', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            default:
                if ($search == '') {
                    $graduates = Graduate::select('id', 'last_name', 'first_name', 'middle_name', 'extension_name', 'employment_status', 'allocation', 'qualification_title')
                    ->orderBy('id', 'desc')->paginate(10);
                }
                else {
                    $graduates = Graduate::where(function($query) use ($search) {
                        $query->where('id', 'LIKE', "%$search%")
                        ->orWhere('full_name', 'LIKE', "%$search%")
                        ->orWhere('last_name', 'LIKE', "%$search%")
                        ->orWhere('first_name', 'LIKE', "%$search%")
                        ->orWhere('extension_name', 'LIKE', "%$search%")
                        ->orWhere('employment_status', 'LIKE', "%$search%")
                        ->orWhere('allocation', 'LIKE', "%$search%")
                        ->orWhere('qualification_title', 'LIKE', "%$search%");
                    })->orderBy('id', 'desc')->paginate(10);
                }
        }

        return view('table-of-graduates.index', compact('graduates', 'search', 'search_category'));
    }

    public function create_view() {
        return view('table-of-graduates.create-record');
    }

    public function create(Request $request) 
    {
        $validated = $request->validate([
            'district' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:50'],
            'tvi' => ['nullable', 'string', 'max:255'],
            'qualification_title' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'extension_name' => ['nullable', 'string', 'max:50'],
            'sex' => ['nullable', 'string', 'max:50'],
            'birthdate' => ['nullable', 'string', 'max:50'],
            'contact_number' => ['nullable', 'string', 'min:13', 'max:16'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'scholarship_type' => ['nullable', 'string', 'max:50'],
            'allocation' => ['nullable', 'string', 'max:50'],
        ]);

        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $district = isset($validated['district']) == true ? $validated['district'] : '';
        $city = isset($validated['city']) == true ? $validated['city'] : '';
        $tvi = isset($validated['tvi']) == true ? $validated['tvi'] : '';
        $qualification_title = isset($validated['qualification_title']) == true ? $validated['qualification_title'] : '';
        $sector = isset($validated['sector']) == true ? $validated['sector'] : '';
        $middle_name = isset($validated['middle_name']) == true ? $validated['middle_name'] : '';
        $extension_name = isset($validated['extension_name']) == true ? $validated['extension_name'] : '';
        $full_name = $this->full_name_format($validated['last_name'], $validated['first_name'], $validated['middle_name'], $validated['extension_name']);
        $sex = isset($validated['sex']) == true ? $validated['sex'] : '';
        $birthdate = isset($validated['birthdate']) == true ? $validated['birthdate'] : '';
        $contact_number = isset($validated['contact_number']) == true ? $validated['contact_number'] : '';
        $email = isset($validated['email']) == true ? $validated['email'] : '';
        $address = isset($validated['address']) == true ? $validated['address'] : '';
        $scholarship_type = isset($validated['scholarship_type']) == true ? $validated['scholarship_type'] : '';
        $allocation = isset($validated['allocation']) == true ? $validated['allocation'] : '';
        $training_status = 'Pass';
        $assessment_result = '';
        $employment_before_training = 'Unemployed';
        $occupation = '';
        $employer_name = '';
        $employer_address = '';
        $employment_type = '';
        $date_hired = '';
        $verification_means = 'For Verification';
        $verification_date = '';
        $verification_status = '';
        $follow_up_date_1 = '';
        $follow_up_date_2 = '';
        $follow_up_remarks = '';
        $response_status = '';
        $not_interested_reason = '';
        $referral_status = 'No';
        $referral_date = '';
        $no_referral_reason = '';
        $invalid_contact = '';
        $company_name = '';
        $company_address = '';
        $job_title = '';
        $application_status = '';
        $not_proceed_reason = '';
        $employment_status = '';
        $hired_date = '';
        $submitted_documents_date = '';
        $interview_date = '';
        $not_hired_reason = '';
        $remarks = '';
        $count = 1;
        $no_of_graduates = 1;
        $no_of_employed = '';
        $verification = '';
        $job_vacancies = 'No';

        Graduate::create([
            'district' => $district,
            'city' => $city,
            'tvi' => $tvi,
            'qualification_title' => $qualification_title,
            'sector' => $sector,
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $middle_name,
            'extension_name' => $extension_name,
            'full_name' => $full_name,
            'sex' => $sex,
            'birthdate' => $birthdate,
            'contact_number' => $contact_number,
            'email' => $email,
            'address' => $address,
            'scholarship_type' => $scholarship_type,
            'training_status' => $training_status,
            'assessment_result' => $assessment_result,
            'employment_before_training' => $employment_before_training,
            'occupation' => $occupation,
            'employer_name' => $employer_name,
            'employer_address' => $employer_address,
            'employment_type' => $employment_type,
            'date_hired' => $date_hired,
            'allocation' => $allocation,
            'verification_means' => $verification_means,
            'verification_date' => $verification_date,
            'verification_status' => $verification_status,
            'follow_up_date_1' => $follow_up_date_1,
            'follow_up_date_2' => $follow_up_date_2,
            'follow_up_remarks' => $follow_up_remarks,
            'response_status' => $response_status,
            'not_interested_reason' => $not_interested_reason,
            'referral_status' => $referral_status,
            'referral_date' => $referral_date,
            'no_referral_reason' => $no_referral_reason,
            'invalid_contact' => $invalid_contact,
            'company_name' => $company_name,
            'company_address' => $company_address,
            'job_title' => $job_title,
            'application_status' => $application_status,
            'not_proceed_reason' => $not_proceed_reason,
            'employment_status' => $employment_status,
            'hired_date' => $hired_date,
            'submitted_documents_date' => $submitted_documents_date,
            'interview_date' => $interview_date,
            'not_hired_reason' => $not_hired_reason,
            'remarks' => $remarks,
            'count' => $count,
            'no_of_graduates' => $no_of_graduates,
            'no_of_employed' => $no_of_employed,
            'verification' => $verification,
            'job_vacancies' => $job_vacancies,
        ]);

        $success_message = 'Created successfully: ' . $full_name . ' - ' . $qualification_title;
        return redirect()->route('admin.table-of-graduates')->with('success', $success_message);
    }

    public function read(Graduate $graduate) {
        return view('table-of-graduates.record-details', compact('graduate'));
    }

    public function update_view(Graduate $graduate) {
        return view('table-of-graduates.update-record', compact('graduate'));
    }

    public function update(Graduate $graduate, Request $request) 
    {
        $validated = $request->validate([
            'verification_means' => ['nullable', 'string', 'max:50'],
            'verification_date' => ['nullable', 'string', 'max:50'],
            'verification_status' => ['nullable', 'string', 'max:50'],
            'follow_up_date_1' => ['nullable', 'string', 'max:50'],
            'follow_up_date_2' => ['nullable', 'string', 'max:50'],
            'follow_up_remarks' => ['nullable', 'string', 'max:255'],
            'response_status' => ['nullable', 'string', 'max:50'],
            'not_interested_reason' => ['nullable', 'string', 'max:255'],
            'referral_status' => ['nullable', 'string', 'max:10'],
            'referral_date' => ['nullable', 'string', 'max:50'],
            'no_referral_reason' => ['nullable', 'string', 'max:255'],
            'invalid_contact' => ['nullable', 'string', 'max:10'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'application_status' => ['nullable', 'string', 'max:255'],
            'not_proceed_reason' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['nullable', 'string', 'max:255'],
            'hired_date' => ['nullable', 'string', 'max:50'],
            'submitted_documents_date' => ['nullable', 'string', 'max:50'],
            'interview_date' => ['nullable', 'string', 'max:50'],
            'not_hired_reason' => ['nullable', 'string', 'max:50'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ]);
        
        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $verification_status = isset($validated['verification_status']) == true ? $validated['verification_status'] : '';
        $follow_up_remarks = isset($validated['follow_up_remarks']) == true ? $validated['follow_up_remarks'] : '';
        $response_status = isset($validated['response_status']) == true ? $validated['response_status'] : '';
        $not_interested_reason = isset($validated['not_interested_reason']) == true ? $validated['not_interested_reason'] : '';
        $referral_status = isset($validated['referral_status']) == true ? $validated['referral_status'] : 'No';
        $referral_date = isset($validated['referral_date']) == true ? $validated['referral_date'] : '';
        $no_referral_reason = isset($validated['no_referral_reason']) == true ? $validated['no_referral_reason'] : '';
        $invalid_contact = isset($validated['invalid_contact']) == true ? $validated['invalid_contact'] : '';

        $company_name = isset($validated['company_name']) == true ? $validated['company_name'] : '';
        $company_address = isset($validated['company_address']) == true ? $validated['company_address'] : '';
        $job_title = isset($validated['job_title']) == true ? $validated['job_title'] : '';
        $application_status = isset($validated['application_status']) == true ? $validated['application_status'] : '';
        $not_proceed_reason = isset($validated['not_proceed_reason']) == true ? $validated['not_proceed_reason'] : ''; 
        $employment_status = isset($validated['employment_status']) == true ? $validated['employment_status'] : '';
        $hired_date = isset($validated['hired_date']) == true ? $validated['hired_date'] : '';
        $submitted_documents_date = isset($validated['submitted_documents_date']) == true ? $validated['submitted_documents_date'] : '';
        $interview_date = isset($validated['interview_date']) == true ? $validated['interview_date'] : '';
        $not_hired_reason = isset($validated['not_hired_reason']) == true ? $validated['not_hired_reason'] : '';
        $remarks = isset($validated['remarks']) == true ? $validated['remarks'] : '';

        $graduate->update([
            'verification_means' => $validated['verification_means'],
            'verification_date' => $validated['verification_date'],
            'verification_status' => $verification_status,
            'follow_up_date_1' => $validated['follow_up_date_1'],
            'follow_up_date_2' => $validated['follow_up_date_2'],
            'follow_up_remarks' => $follow_up_remarks,
            'response_status' => $response_status,
            'not_interested_reason' => $not_interested_reason,
            'referral_status' => $referral_status,
            'referral_date' => $referral_date,
            'no_referral_reason' => $no_referral_reason,
            'invalid_contact' => $invalid_contact,
            'company_name' => $company_name,
            'company_address' => $company_address,
            'job_title' => $job_title,
            'application_status' => $application_status,
            'not_proceed_reason' => $not_proceed_reason,
            'employment_status' => $employment_status,
            'hired_date' => $hired_date,
            'submitted_documents_date' => $submitted_documents_date,
            'interview_date' => $interview_date,
            'not_hired_reason' => $not_hired_reason,
            'remarks' => $remarks,
        ]);

        return redirect()->route('admin.record-details', $graduate->id)->with('success', 'Updated record successfully!');
    }

    public function delete(Graduate $graduate) {
        $full_name = $graduate->full_name;
        $qualification_title = $graduate->qualification_title;
        $success_message = 'Deleted successfully: ' . $full_name . ' - ' . $qualification_title;

        $graduate->delete();
        return redirect()->route('admin.table-of-graduates')->with('success', $success_message);
    }

    public function truncate() {
        Graduate::truncate();
        return redirect()->route('admin.table-of-graduates')->with('success', 'Cleared all records successfully!');
    }

    private function full_name_format($last_name, $first_name, $middle_name, $extension_name) 
    {
        $format = "";

        if (empty($middle_name) && empty($extension_name)) {
            $format = $last_name . ", " . $first_name;
        } 
        else if (empty($extension_name)) {
            $format = "$last_name, $first_name $middle_name";
        } 
        else if (empty($middle_name)) {
            $format = "$last_name $extension_name, $first_name";
        } 
        else {
            $format = "$last_name $extension_name, $first_name $middle_name";
        }

        return $format;
    }
}
