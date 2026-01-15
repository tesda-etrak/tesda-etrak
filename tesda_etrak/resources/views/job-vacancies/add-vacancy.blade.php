@section('title', 'E-TRAK - Add Vacancy')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/job-vacancies/add-vacancy.js'])
@endsection

@section('main', 'Add Vacancy')

@php
    
@endphp

<x-layout>
    <div class="mb-5">
        <a href="{{ route('admin.job-vacancies') }}" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline-block">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
            </svg> Go Back
        </a>
    </div>
    <div class="bg-gray-100 border border-gray-300 mx-auto p-8 rounded-lg shadow-md">
        @if ($errors->any())
            <ul class="bg-red-400 mb-5 px-3 py-2 rounded-md">
                @foreach ($errors->all() as $error)
                    <li class="text-md text-white">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('admin.add-vacancy') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="request_date" class="form-label">Request Date</label>
                <input type="date" name="request_date" id="requestDate" class="form-input" value="{{ old('request_date') }}" />
            </div>
            <div>
                <label for="company_id" class="form-label">Company</label>
                <select name="company_id" id="companyId" class="form-input">
                    <option value="">-- Select a Company --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="sector" class="form-label">Sector</label>
                <input type="text" name="sector" id="sector" class="form-input" value="{{ old('sector') }}" />
            </div>
            <div>
                <label for="vacancies" class="form-label">Vacancy</label>
                <input type="text" name="vacancies" id="vacancies" class="form-input" value="{{ old('vacancies') }}" />
            </div>
            <div>
                <label for="related_qualifications" class="form-label">Related Qualification</label>
                <input type="text" name="related_qualifications" id="relatedQualifications" class="form-input" value="{{ old('related_qualifications') }}" />
            </div>
            <div>
                <label for="job_titles" class="form-label">Job Title</label>
                <input type="text" name="job_titles" id="jobTitles" class="form-input" value="{{ old('job_titles') }}" />
            </div>
            <div>
                <label for="tr_qualifications" class="form-label">TR Qualification</label>
                <input type="text" name="tr_qualifications" id="trQualifications" class="form-input" value="{{ old('tr_qualifications') }}" />
            </div>
            <div>
                <label for="no_of_vacancies" class="form-label">Number of Vacancies</label>
                <input type="text" name="no_of_vacancies" id="numOfVacancies" class="form-input" value="{{ old('no_of_vacancies') }}" />
            </div>
            <div>
                <label for="deployment_location" class="form-label">Deployment Location</label>
                <input type="text" name="deployment_location" id="deploymentLocation" class="form-input" value="{{ old('deploymentLocation') }}" />
            </div>
            <div>
                <label for="no_of_referred" class="form-label">Number of Referred</label>
                <input type="text" name="no_of_referred" id="numOfReferred" class="form-input" value="{{ old('no_of_referred') }}" />
            </div>
            <div>
                <label for="no_of_hired" class="form-label">Number of Hired</label>
                <input type="text" name="no_of_hired" id="numOfHired" class="form-input" value="{{ old('no_of_hired') }}" />
            </div>
            <div>
                <label for="remarks" class="form-label">Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-input" value="{{ old('remarks') }}" />
            </div>
            <div>
                <label for="attachment_link" class="form-label">Attachment Link</label>
                <input type="text" name="attachment_link" id="attachmentLink" class="form-input" value="{{ old('attachment_link') }}" />
            </div>
            <div class="flex items-center justify-baseline">
                <button type="button" class="btn btn-primary rounded-lg mr-2" id="btnAdd">Add</button>
            </div>
            {{-- Modal --}}
            <div id="addVacancyModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Add Vacancy</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Do you confirm adding this vacancy?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 lg:flex lg:flex-row-reverse lg:px-6">
                                <input type="submit" name="add" class="btn-primary-modal" role="button" value="Confirm" />
                                <button type="button" id="btnCancel" class="btn-secondary-modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>