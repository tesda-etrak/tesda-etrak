@section('title', 'E-TRAK - View Companies')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/job-vacancies/view-companies.js'])
@endsection

@section('main', 'Companies with Vacancies')

<x-layout>
    <div class="flex items-center justify-start mb-1">
        <div class="flex flex-row-reverse">
            <a href="{{ route('admin.add-company.view') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 inline-block">
                    <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                </svg> Add Company
            </a>
            <a href="{{ route('admin.job-vacancies') }}" class="btn btn-secondary mx-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline-block">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                </svg> Go Back
            </a>
        </div>
    </div>
    <section class="flex items-center justify-center space-x-2" x-data="{ company: null, loading: false }">
        <!-- Card Grid -->
        <div class="bg-gray-300 p-6 lg:p-8 rounded-lg lg:rounded-xl w-full lg:w-full">
            <div class="max-w-full mx-auto h-[calc(2.9*10rem)] lg:h-[calc(3.8*10rem)] overflow-y-auto pr-2">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($companies as $company)
                        <button type="button" class="cards group bg-gray-100 hover:bg-white border border-gray-300 cursor-pointer p-4 rounded-lg lg:rounded-xl shadow-sm text-center transition" 
                        @click="loading = true; 
                        fetch('{{ route('admin.company.api', $company->id) }}').then(res => res.json()).then(data => { company = data; loading = false; })">
                            <!-- Company Logo -->
                            <div class="flex items-center justify-center mb-4">
                                <img src="{{ $company->logo_url ? asset('storage/' . $company->logo_url) : asset('images/logo.png') }}" 
                                alt="{{ $company->name }} Logo" class="h-full max-h-12 object-contain">
                            </div>
                            <!-- Name -->
                            <h3 class="font-semibold text-md text-gray-800 truncate">{{ $company->name }}</h3>
                            <!-- Sector -->
                            <span class="text-sm text-gray-500 mt-1">{{ $company->city }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Company Details -->
        <div class="bg-gray-100 border border-gray-400 hidden lg:block p-8 rounded-xl shadow-md w-full">
            <div class="h-[calc(3.8*10rem)] max-w-full mx-auto overflow-y-auto">
                {{-- Loading Spinner --}}
                <template x-if="loading">
                    <div class="flex items-center justify-center h-64">
                        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </div>
                </template>
                <template x-if="company && !loading">
                    <div>
                        <!-- Company Logo -->
                        <div class="flex items-center space-x-4 mb-6">
                            <img :src="'{{ url('/storage') }}/' + company.logo_url || '{{ asset('images/logo_default.png') }}'" 
                            :alt="company.name + ' Logo'" class="max-w-24 w-full object-contain">
                            <div>
                                <h3 class="font-semibold text-3xl text-gray-900" x-text="company.name"></h3>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="my-4">
                            <dl>
                                <dt>City: </dt>
                                <dd class="text-gray-600" x-text="company.city"></dd>
                                <dt>Address: </dt>
                                <dd class="text-gray-600" x-text="company.address"></dd>
                                <dt>Contact Details: </dt>
                                <dd class="text-gray-600" x-text="company.contact_details ?? 'N/A'"></dd>
                            </dl>
                        </div>
                        <!-- Link to Profile -->
                        <div class="my-6 hidden">
                            <a href="#" class="btn-primary-modal">Go to Profile</a>
                            <a href="#" class="btn-secondary-modal-solid">Edit</a>
                            <a href="#" class="btn-danger-modal">Delete</a>
                        </div>
                    </div>
                </template>
                <!-- Placeholder when no company is selected -->
                <template x-if="!company && !loading">
                    <div class="text-xl text-gray-500">
                        <p>Select a company to see details</p>
                    </div>
                </template>
            </div>
        </div>
    </section>
</x-layout>