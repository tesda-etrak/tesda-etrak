@section('title', 'E-TRAK - Add Company')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/job-vacancies/add-company.js'])
@endsection

@section('main', 'Add Company')

<x-layout>
    <div class="mb-5">
        <a href="{{ route('admin.job-vacancies') }}" class="btn btn-secondary">Go Back</a>
    </div>
    <div class="bg-white border border-gray-300 mx-auto p-8 rounded-lg shadow-md">
        @if ($errors->any())
            <ul class="bg-red-400 mb-5 px-3 py-2 rounded-md">
                @foreach ($errors->all() as $error)
                    <li class="text-md text-white">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('admin.add-company') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-input" value="{{ old('name') }}" autofocus />
            </div>
            <div>
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-input" value="{{ old('city') }}" />
            </div>
            <div>
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-input" value="{{ old('address') }}" />
            </div>
            <div>
                <label for="contact_details" class="form-label">Contact Details</label>
                <input type="text" name="contact_details" id="contactDetails" class="form-input" value="{{ old('contact_details') }}" />
            </div>
            <div>
                <label for="logo_url" class="form-label">Company Logo</label>
                <input type="file" name="logo_url" id="logoUrl" accept="image/*" class="form-input" value="{{ old('logo_url') }}" />
            </div>
            <div class="flex items-center justify-baseline">
                <button type="button" class="btn btn-primary rounded-lg mr-2" id="btnAdd">Add</button>
            </div>
            {{-- Modal --}}
            <div id="addCompanyModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Add Company</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Do you confirm adding this company?
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