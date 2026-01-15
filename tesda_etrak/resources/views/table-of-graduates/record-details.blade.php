@section('title', 'E-TRAK - Record details')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/table-of-graduates/record-details.js'])
@endsection

@section('main', 'Record Details')

<x-layout>
    <div class="block mb-4">
        <span class="text-4xl font-bold border-b-4">{{ $graduate->full_name }} - {{ $graduate->qualification_title }}</span>
    </div>
    <div class="flex items-center justify-baseline">
        <div class="flex" id="tabs">
            <button class="px-4 py-2 rounded-t-sm text-white bg-neutral-500" id="detailsTab">Details</button>
            <button class="px-4 py-2 rounded-t-sm text-black bg-transparent hover:bg-neutral-300" id="verificationTab">Verification</button>
            <button class="px-4 py-2 rounded-t-sm text-black bg-transparent hover:bg-neutral-300" id="employmentTab">Employment</button>
        </div>
        <div class="block ml-auto">
            <a href="{{ route('admin.table-of-graduates') }}" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline-block">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg> Back
            </a>
            <a href="{{ route('admin.update-record.view', $graduate->id) }}" class="btn btn-primary mx-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline-block mb-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg> Update
            </a>
            <a class="btn btn-danger" id="btnDelete">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 inline-block mb-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg> Delete
            </a>
        </div>
    </div>
    <div class="bg-neutral-200 border-t p-4">
        <div class="h-[calc(3.53*10rem)] max-w-full mx-auto overflow-y-auto">
            <div class="tab-content">
                <dl>
                    <dt>Name: </dt>
                    <dd>{{ $graduate->full_name }}</dd>
                    <dt>District: </dt>
                    <dd>{{ $graduate->district }}</dd>
                    <dt>City: </dt>
                    <dd>{{ $graduate->city }}</dd>
                    <dt>Type of Scholarship: </dt>
                    <dd>{{ $graduate->scholarship_type }}</dd>
                    <dt>Name of TVI: </dt>
                    <dd>{{ $graduate->tvi }}</dd>
                    <dt>Qualification Title: </dt>
                    <dd>{{ $graduate->qualification_title }}</dd>
                    <dt>Sector: </dt>
                    <dd>{{ $graduate->sector }}</dd>
                    <dt>Year of Graduation: </dt>
                    <dd>{{ $graduate->allocation }}</dd>
                    <dt>Sex: </dt>
                    <dd>{{ $graduate->sex }}</dd>
                    <dt>Date of Birth: </dt>
                    <dd class="dateFormat">{{ $graduate->birthdate }}</dd>
                    <dt>Contact Number: </dt>
                    <dd>{{ $graduate->contact_number }}</dd>
                    <dt>E-mail Address: </dt>
                    <dd>{{ $graduate->email }}</dd>
                    <dt>Address: </dt>
                    <dd>{{ $graduate->address }}</dd>
                </dl>
            </div>
            <div class="tab-content hidden">
                <dl>
                    <dt>Means of Verification: </dt>
                    <dd>{{ $graduate->verification_means }}</dd>
                    <dt>Date of Verification: </dt>
                    <dd class="dateFormat">{{ $graduate->verification_date }}</dd>
                    <dt>Status of Verification: </dt>
                    <dd id="verification_status">{{ $graduate->verification_status }}</dd>
        
                    @switch($graduate->verification_status)
                        @case("Responded")
                            <dt>Status of Response: </dt>
                            <dd>{{ $graduate->response_status }}</dd>
        
                            @switch($graduate->response_status)
                                @case("Interested")
                                    <dt>Refer to Company? </dt>
                                    <dd id="referralStatus">{{ $graduate->referral_status }}</dd>
        
                                    @if ($graduate->referral_status === "Yes")
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                    @elseif ($graduate->referral_status === "No")
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @else
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @endif
                                    @break
        
                                @case("Not Interested")
                                    <dt>Reason (Not Interested): </dt>
                                    <dd>{{ $graduate->not_interested_reason }}</dd>
                                    @break
        
                                @default
                                    {{-- response_status: "Interested" --}}
                                    <dt>Refer to Company? </dt>
                                    <dd>{{ $graduate->referral_status }}</dd>
        
                                    @if ($graduate->referral_status === "Yes")
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                    @elseif ($graduate->referral_status === "No")
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @else
                                        {{-- referral_status: "Yes" --}}
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                        {{-- referral_status: "No" --}}
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @endif

                                    {{-- response_status: "Not Interested" --}}
                                    <dt>Reason (Not Interested): </dt>
                                    <dd>{{ $graduate->not_interested_reason }}</dd>
                            @endswitch
                            @break
        
                        @case("No Response (For Follow-up)")
                            <dt>First Follow-up Date: </dt>
                            <dd class="dateFormat">{{ $graduate->follow_up_date_1 }}</dd>
                            <dt>Second Follow-up Date: </dt>
                            <dd class="dateFormat">{{ $graduate->follow_up_date_2 }}</dd>
        
                            @if (!empty($graduate->invalid_contact))
                                <dt>Invalid Contact? </dt>
                                <dd>{{ $graduate->invalid_contact }}</dd>
                            @endif

                            <dt>Remarks: </dt>
                            <dd>{{ $graduate->follow_up_remarks }}</dd>
                            @break
        
                        @default
                            {{-- verification_status: "Responded" --}}
                            <dt>Status of Response: </dt>
                            <dd>{{ $graduate->response_status }}</dd>
        
                            @switch($graduate->response_status)
                                @case("Interested")
                                    <dt>Refer to Company? </dt>
                                    <dd id="referralStatus">{{ $graduate->referral_status }}</dd>
        
                                    @if ($graduate->referral_status === "Yes")
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                    @elseif ($graduate->referral_status === "No")
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @else
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @endif
                                    @break
        
                                @case("Not Interested")
                                    <dt>Reason (Not Interested): </dt>
                                    <dd>{{ $graduate->not_interested_reason }}</dd>
                                    @break
        
                                @default
                                    {{-- response_status: "Interested" --}}
                                    <dt>Refer to Company? </dt>
                                    <dd id="referralStatus">{{ $graduate->referral_status }}</dd>
        
                                    @if ($graduate->referral_status === "Yes")
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                    @elseif ($graduate->referral_status === "No")
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @else
                                        {{-- referral_status: "Yes" --}}
                                        <dt>Date of Referral: </dt>
                                        <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                        {{-- referral_status: "No" --}}
                                        <dt>Reason (No Referral): </dt>
                                        <dd>{{ $graduate->no_referral_reason }}</dd>
                                    @endif
        
                                    {{-- response_status: "Not Interested" --}}
                                    <dt>Reason (Not Interested): </dt>
                                    <dd>{{ $graduate->not_interested_reason }}</dd>
                            @endswitch
        
                            {{-- verification_status: "No Response (For Follow-up)" --}}
                            <dt>First Follow-up Date: </dt>
                            <dd class="dateFormat">{{ $graduate->follow_up_date_1 }}</dd>
                            <dt>Second Follow-up Date: </dt>
                            <dd class="dateFormat">{{ $graduate->follow_up_date_2 }}</dd>
                            
                            @if (!empty($graduate->invalid_contact))
                                <dt>Invalid Contact? </dt>
                                <dd>{{ $graduate->invalid_contact }}</dd>
                            @endif
                    @endswitch
                </dl>
            </div>
            <div class="tab-content hidden">
                <dl>
                    <dt>Company Name: </dt>
                    <dd>{{ $graduate->company_name }}</dd>
                    <dt>Company Address: </dt>
                    <dd>{{ $graduate->company_address }}</dd>
                    <dt>Job Title: </dt>
                    <dd>{{ $graduate->job_title }}</dd>
        
                    <dt>Application Status: </dt>
                    <dd>{{ $graduate->application_status }}</dd>
                    @switch($graduate->application_status)
                        @case("Proceeded")
                            <dt>Status of Employment: </dt>
                            <dd>{{ $graduate->employment_status }}</dd>
                            @switch($graduate->employment_status)
                                @case("Hired")
                                    <dt>Date Hired: </dt>
                                    <dd class="dateFormat">{{ $graduate->hired_date }}</dd>
                                    @break
                                @case("Submitted Documents")
                                    <dt>Submission of Documents Date: </dt>
                                    <dd class="dateFormat">{{ $graduate->submitted_documents_date }}</dd>
                                    @break
                                @case("For Interview")
                                    <dt>Interview Date: </dt>
                                    <dd class="dateFormat">{{ $graduate->interview_date }}</dd>
                                    @break
                                @case("Not Hired")
                                    <dt>Reason (Not Hired): </dt>
                                    <dd>{{ $graduate->not_hired_reason }}</dd>
                                    @break
                                @default
                                    <dt class="ms-[30px]">Date Hired: </dt>
                                    <dd class="ms-[30px] dateFormat">{{ $graduate->hired_date }}</dd>
                                    <dt class="ms-[30px]">Submission of Documents Date: </dt>
                                    <dd class="ms-[30px] dateFormat">{{ $graduate->submitted_documents_date }}</dd>
                                    <dt class="ms-[30px]">Interview Date: </dt>
                                    <dd class="ms-[30px] dateFormat">{{ $graduate->interview_date }}</dd>
                                    <dt class="ms-[30px]">Reason (Not Hired): </dt>
                                    <dd class="ms-[30px]">{{ $graduate->not_hired_reason }}</dd>
                            @endswitch

                            <dt>Remarks: </dt>
                            <dd>{{ $graduate->remarks }}</dd>
                            @break
        
                        @case("Did Not Proceed")
                            <dt>Reason (Did Not Proceed): </dt>
                            <dd>{{ $graduate->not_proceed_reason }}</dd>
                            @break
        
                        @default
                            {{-- application_status: "Proceed" --}}
                            <dt>Status of Employment: </dt>
                            <dd>{{ $graduate->employment_status }}</dd>
                            @switch($graduate->employment_status)
                                @case("Hired")
                                    <dt>Date Hired: </dt>
                                    <dd class="dateFormat">{{ $graduate->hired_date }}</dd>
                                    @break
                                @case("Submitted Documents")
                                    <dt>Submission of Documents Date: </dt>
                                    <dd class="dateFormat">{{ $graduate->submitted_documents_date }}</dd>
                                    @break
                                @case("For Interview")
                                    <dt>Interview Date: </dt>
                                    <dd class="dateFormat">{{ $graduate->interview_date }}</dd>
                                    @break
                                @case("Not Hired")
                                    <dt>Reason (Not Hired): </dt>
                                    <dd>{{ $graduate->not_hired_reason }}</dd>
                                    @break
                                @default
                                    <dt class="ms-[30px]">Date Hired: </dt>
                                    <dd class="ms-[30px] dateFormat">{{ $graduate->hired_date }}</dd>
                                    <dt class="ms-[30px]">Submission of Documents Date: </dt>
                                    <dd class="ms-[30px] dateFormat">{{ $graduate->submitted_documents_date }}</dd>
                                    <dt class="ms-[30px]">Interview Date: </dt>
                                    <dd class="ms-[30px] dateFormat">{{ $graduate->interview_date }}</dd>
                                    <dt class="ms-[30px]">Reason (Not Hired): </dt>
                                    <dd class="ms-[30px]">{{ $graduate->not_hired_reason }}</dd>
                            @endswitch
                            
                            <dt>Remarks: </dt>
                            <dd>{{ $graduate->remarks }}</dd>

                            {{-- application_status: "Don't Proceed" --}}
                            <dt>Reason (Did Not Proceed): </dt>
                            <dd>{{ $graduate->not_proceed_reason }}</dd>
                    @endswitch
                </dl>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="relative z-10 hidden" id="deleteModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Delete Record</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this record? All of its data will be permanently removed and this action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="bg-gray-50 px-4 py-3 lg:hidden">
                            <input type="submit" name="delete" class="btn-danger-modal" role="button" value="Delete" />
                            <button type="button" id="cancelDelete" class="btn-secondary-modal">Cancel</button>
                        </div>
                        <div class="bg-gray-50 hidden lg:flex flex-row-reverse px-6 py-3">
                            <input type="submit" name="delete" class="btn-danger-modal" role="button" value="Delete" />
                            <button type="button" id="cancelDelete_desktop" class="btn-secondary-modal mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>