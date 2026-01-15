@section('title', 'E-TRAK - Update a record')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/table-of-graduates/update-record.js'])
@endsection

@section('main', 'Update Record')

@php
    $verification_means = [
        "For Verification", "E-mail", "Phone (SMS & Call)", "Phone and E-mail"
    ];
    $not_hired_reasons = [
        "Underage", "Upskilling", "Lack of Experience", "Did not meet the requirements"
    ];
@endphp

<x-layout>
    <div class="mx-auto bg-white px-8 pb-8 pt-5 rounded-lg shadow-md">
        <div class="block mb-2">
            <span class="text-4xl font-bold border-b-4">{{ $graduate->full_name }} - {{ $graduate->qualification_title }}</span>
        </div>
        @if ($errors->any())
            <ul class="px-3 py-2 bg-red-400 rounded-md mb-5">
                @foreach ($errors->all() as $error)
                    <li class="text-md text-white">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="w-full">
            <div class="flex border-b" id="tabs">
                <button class="px-4 py-2 border-b-2 border-black" id="tabDetails">Details</button>
                <button class="px-4 py-2 border-b-2 border-transparent hover:border-gray-300" id="tabVerification">Verification</button>
                <button class="px-4 py-2 border-b-2 border-transparent hover:border-gray-300 hidden" id="tabEmployment">Employment</button>
            </div>
        </div>
        <div class="p-4">
            <form action="{{ route('admin.update-record', $graduate->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="tab-content" id="details">
                    <fieldset disabled>
                        <div class="mb-5">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-input bg-gray-200" value="{{ $graduate->last_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-input bg-gray-200" value="{{ $graduate->first_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-input bg-gray-200" value="{{ $graduate->middle_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="extension_name" class="form-label">Extension Name</label>
                            <input type="text" name="extension_name" id="extension_name" class="form-input bg-gray-200" value="{{ $graduate->extension_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="sex" class="form-label">Sex</label>
                            <input type="text" name="sex" id="sex" class="form-input bg-gray-200" value="{{ $graduate->sex }}" />
                        </div>
                        <div class="mb-5">
                            <label for="birthdate" class="form-label">Date of Birth</label>
                            <input type="text" name="birthdate" id="birthdate" class="form-input bg-gray-200 dateFormat" value="{{ $graduate->birthdate }}" />
                        </div>
                        <div class="mb-5">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-input bg-gray-200" value="{{ $graduate->contact_number }}" />
                        </div>
                        <div class="mb-5">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" rows="3" class="form-input bg-gray-200">{{ $graduate->address }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label for="email" class="form-label">E-mail Address</label>
                            <input type="text" name="email" id="email" class="form-input bg-gray-200" value="{{ $graduate->email }}" />
                        </div>
                        <div class="mb-5">
                            <label for="sector" class="form-label">Sector</label>
                            <input type="text" name="sector" id="sector" class="form-input bg-gray-200" value="{{ $graduate->sector }}" />
                        </div>
                        <div class="mb-5">
                            <label for="qualification_title" class="form-label">Qualification Title</label>
                            <input type="text" name="qualification_title" id="qualification_title" class="form-input bg-gray-200" value="{{ $graduate->qualification_title }}" />
                        </div>
                        <div class="mb-5">
                            <label for="district" class="form-label">District</label>
                            <input type="text" name="district" id="district" class="form-input bg-gray-200" value="{{ $graduate->district }}" />
                        </div>
                        <div class="mb-5">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-input bg-gray-200" value="{{ $graduate->city }}" />
                        </div>
                        <div class="mb-5">
                            <label for="scholarship_type" class="form-label">Type of Scholarship</label>
                            <input type="text" name="scholarship_type" id="scholarship_type" class="form-input bg-gray-200" value="{{ $graduate->scholarship_type }}" />
                        </div>
                        <div class="mb-5">
                            <label for="tvi" class="form-label">Name of TVI</label>
                            <input type="text" name="tvi" id="tvi" class="form-input bg-gray-200" value="{{ $graduate->tvi }}" />
                        </div>
                        <div class="mb-5">
                            <label for="allocation" class="form-label">Allocation</label>
                            <input type="text" name="allocation" id="allocation" class="form-input bg-gray-200" value="{{ $graduate->allocation }}" />
                        </div>
                    </fieldset>
                </div>
                <div class="tab-content hidden" id="verification">
                    <div class="mb-5">
                        <label for="verification_means" class="form-label">Means of Verification</label>
                        <select name="verification_means" id="verification_means" class="form-input">
                            <option value="">-- Select a means of verification --</option>
                            @foreach ($verification_means as $means)
                                <option value="{{ $means }}" {{ old('verification_means', $graduate->verification_means) == $means ? 'selected' : '' }}>
                                    {{ $means }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="verification_date" class="form-label">Date of Verification</label>
                        <input type="date" name="verification_date" id="verification_date" class="form-input" value="{{ old('verification_date', $graduate->verification_date) }}" />
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Status of Verification</label>
                        <div class="mt-2 space-y-2">
                            <label for="btnNone" class="flex items-center">
                                <input type="radio" name="verification_status" id="btnNone" class="form-radio" value="" {{ old('verification_status', $graduate->verification_status) == '' ? 'checked' : '' }} />
                                <span class="ml-2 text-gray-700">None</span>
                            </label>
                            <label for="btnResponded" class="flex items-center">
                                <input type="radio" name="verification_status" id="btnResponded" class="form-radio" value="Responded" {{ old('verification_status', $graduate->verification_status) == 'Responded' ? 'checked' : '' }} />
                                <span class="ml-2 text-gray-700">Responded</span>
                            </label>
                            <label for="btnNoResponse" class="flex items-center">
                                <input type="radio" name="verification_status" id="btnNoResponse" class="form-radio" value="No Response (For Follow-up)" {{ old('verification_status', $graduate->verification_status) == 'No Response (For Follow-up)' ? 'checked' : '' }} />
                                <span class="ml-2 text-gray-700">No Response (For Follow-up)</span>
                            </label>
                        </div>
                        <hr class="mt-5">
                    </div>
                    <div class="hidden mb-4" id="divResponded">
                        <div>
                            <label class="form-label">Type of Response</label>
                            <div class="mt-2 space-y-2 ml-[30px]">
                                <label for="btnInterested" class="flex items-center">
                                    <input type="radio" name="response_status" id="btnInterested" class="form-radio" value="Interested" {{ old('response_status', $graduate->response_status) == 'Interested' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Interested</span>
                                </label>
                                <label for="btnNotInterested" class="flex items-center">
                                    <input type="radio" name="response_status" id="btnNotInterested" class="form-radio" value="Not Interested" {{ old('response_status', $graduate->response_status) == 'Not Interested' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Not Interested</span>
                                </label>
                                <!-- response_status : Interested -->
                                <div class="hidden my-0" id="divInterested">
                                    <label class="form-label">Refer to Company?</label>
                                    <fieldset id="referralStatusForm" class="mt-2 space-y-2" disabled>
                                        <!-- referral_status : Yes -->
                                        <label for="btnYes" class="flex items-center">
                                            <input type="radio" name="referral_status" id="btnYes" class="form-radio" value="Yes" {{ old('referral_status', $graduate->referral_status) == 'Yes' ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-700">YES</span>
                                        </label>
                                        <input type="date" name="referral_date" id="referral_date" class="form-input mb-3 ml-5 bg-gray-200" value="{{ old('referral_date', $graduate->referral_date) }}" disabled />
                                        <!-- referral_status : No -->
                                        <label for="btnNo" class="flex items-center">
                                            <input type="radio" name="referral_status" id="btnNo" class="form-radio" value="No" {{ old('referral_status', $graduate->referral_status) == 'No' ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-700">NO</span>
                                        </label>
                                        <textarea name="no_referral_reason" id="no_referral_reason" rows="3" class="form-input mb-3 ml-5 bg-gray-200" placeholder="Reason" disabled>{{ old('no_referral_reason', $graduate->no_referral_reason) }}</textarea>
                                    </fieldset>
                                </div>
                                <!-- response_status : Not Interested -->
                                <div class="hidden my-0" id="divNotInterested">
                                    <label for="not_interested_reason" class="form-label">Reason</label>
                                    <textarea name="not_interested_reason" id="not_interested_reason" rows="3" class="form-input" disabled>{{ old('not_interested_reason', $graduate->not_interested_reason) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden mb-4" id="divNoResponse">
                        <div>
                            <label class="form-label mb-4">No Response (For Follow-up)</label>
                            <div class="mb-4 ml-[30px]">
                                <label for="follow_up_date_1" class="form-label">First Follow-up</label>
                                <input type="date" name="follow_up_date_1" id="follow_up_date_1" class="form-input" value="{{ old('follow_up_date_1', $graduate->follow_up_date_1) }}" />
                            </div>
                            <div class="mb-4 ml-[30px]">
                                <label for="follow_up_date_2" class="form-label">Second Follow-up</label>
                                <input type="date" name="follow_up_date_2" id="follow_up_date_2" class="form-input" value="{{ old('follow_up_date_2', $graduate->follow_up_date_2) }}" />
                            </div>
                            <div class="mb-4 ml-[30px]">
                                <label for="invalid_contact" class="flex items-center">
                                    <input type="checkbox" name="invalid_contact" id="invalid_contact" {{ old('invalid_contact', $graduate->invalid_contact) == 'Yes' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Invalid Contact</span>
                                </label>
                            </div>
                            <div class="mb-4 ml-[30px] mt-6">
                                <textarea name="follow_up_remarks" id="follow_up_remarks" rows="3" placeholder="Remarks" class="form-input">{{ old('follow_up_remarks', $graduate->follow_up_remarks) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-baseline">
                        <button type="button" class="btn btn-primary rounded-lg mr-2" id="btnUpdate_1">Update</button>
                        <a href="{{ route('admin.record-details', $graduate->id) }}" class="btn btn-secondary rounded-lg">Cancel</a>
                    </div>
                </div>
                <div class="tab-content hidden" id="employment">
                    <div>
                        <fieldset id="employmentField" disabled>
                            <div class="mb-5">
                                <label for="company_name" class="form-label">Name of Company</label>
                                <input type="text" name="company_name" id="company_name" class="form-input" value="{{ old('company_name', $graduate->company_name) }}" />
                            </div>
                            <div class="mb-5">
                                <label for="company_address" class="form-label">Address of Company</label>
                                <textarea name="company_address" id="company_address" rows="3" class="form-input">{{ old('company_address', $graduate->company_address) }}</textarea>
                            </div>
                            <div class="mb-5">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" name="job_title" id="job_title" class="form-input" value="{{ old('job_title', $graduate->job_title) }}" />
                            </div>
                            <div class="mt-2 space-y-2">
                                <label class="form-label">Application Status</label>
                                <label for="btnProceed" class="flex items-center">
                                    <input type="radio" name="application_status" id="btnProceed" class="form-radio" value="Proceeded" {{ old('application_status', $graduate->application_status) == 'Proceed' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Proceed</span>
                                </label>
                                <label for="btnNotProceed" class="flex items-center">
                                    <input type="radio" name="application_status" id="btnNotProceed" class="form-radio" value="Did Not Proceed" {{ old('application_status', $graduate->application_status) == 'Don\'t Proceed' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Will Not Proceed</span>
                                </label>
                            </div>
                            <hr class="my-4">
                            <!-- application_status : Proceeded -->
                            <div class="mt-2 space-y-2" id="divProceed">
                                <label class="form-label">Employment Status</label>
                                <!-- employment_status : Hired -->
                                <label for="btnHired" class="flex items-center">
                                    <input type="radio" name="employment_status" id="btnHired" class="form-radio" value="Hired" {{ old('employment_status', $graduate->employment_status) == 'Hired' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Hired</span>
                                </label>
                                <input type="date" name="hired_date" id="hired_date" class="form-input mb-3 ml-5" value="{{ old('hired_date', $graduate->hired_date) }}" disabled />
                                <!-- employment_status : Submitted Documents -->
                                <label for="btnSubmitDocs" class="flex items-center">
                                    <input type="radio" name="employment_status" id="btnSubmitDocs" class="form-radio" value="Submitted Documents" {{ old('employment_status', $graduate->employment_status) == 'Submitted Documents' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Submitted Documents</span>
                                </label>
                                <input type="date" name="submitted_documents_date" id="submitted_documents_date" class="form-input mb-3 ml-5" value="{{ old('submitted_documents_date', $graduate->submitted_documents_date) }}" disabled />
                                <!-- employment_status : For Interview -->
                                <label for="btnForInterview" class="flex items-center">
                                    <input type="radio" name="employment_status" id="btnForInterview" class="form-radio" value="For Interview" {{ old('employment_status', $graduate->employment_status) == 'For Interview' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">For Interview</span>
                                </label>
                                <input type="date" name="interview_date" id="interview_date" class="form-input mb-3 ml-5" value="{{ old('interview_date', $graduate->interview_date) }}" disabled />
                                <!-- employment_status : Not Hired -->
                                <label for="btnNotHired" class="flex items-center">
                                    <input type="radio" name="employment_status" id="btnNotHired" class="form-radio" value="Not Hired" {{ old('employment_status', $graduate->employment_status) == 'Not Hired' ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Not Hired</span>
                                </label>
                                <select name="not_hired_reason" id="not_hired_reason" class="form-input mb-3 ml-5" disabled>
                                    <option value="">-- Select a reason --</option>
                                    @foreach ($not_hired_reasons as $reason)
                                        <option value="{{ $reason }}" {{ old('not_hired_reason', $graduate->not_hired_reason) == $reason ? 'selected' : '' }}>
                                            {{ $reason }}
                                        </option>
                                    @endforeach
                                </select>
                                <textarea name="remarks" id="remarks" rows="3" class="form-input my-5" placeholder="Remarks" disabled>{{ old('remarks', $graduate->remarks) }}</textarea>
                            </div>
                            <!-- application_status : Did Not Proceed -->
                            <div class="mb-5" id="divNotProceed">
                                <label for="not_proceed_reason" class="form-label">Reason</label>
                                <textarea name="not_proceed_reason" id="not_proceed_reason" rows="3" class="form-input">{{ old('not_proceed_reason', $graduate->not_proceed_reason) }}</textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="flex items-center justify-baseline">
                        <button type="button" class="btn btn-primary rounded-lg mr-2" id="btnUpdate_2">Update</button>
                        <a href="{{ route('admin.record-details', $graduate->id) }}" class="btn btn-secondary rounded-lg">Cancel</a>
                    </div>
                </div>
                {{-- Modal --}}
                <div class="relative z-10 hidden" id="modalUpdate" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                              </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Update Record</h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    Do you confirm updating record information of <strong>{{ $graduate->full_name }}</strong>?
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                    <input type="submit" name="update" class="btn-primary-modal" role="button" value="Confirm" />
                                    <button type="button" id="btnCancelUpdate" class="btn-secondary-modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>