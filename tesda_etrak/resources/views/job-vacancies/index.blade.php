@section('title', 'E-TRAK - Job Vacancies')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/job-vacancies/index.js'])
@endsection

@section('main', 'Job Vacancies')

@php
    $categories = [
        "Name of Company", 
        "Contact Details", 
        "No. of Vacancies", 
        "Deployment Location",
    ];
@endphp

<x-layout>
    @alladmin
        <div class="flex items-center justify-start mb-4">
            <div class="block">
                <a href="{{ route('admin.add-vacancy.view') }}" class="btn btn-primary mr-1.5 pb-3.5 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 inline-block mb-0.5">
                        <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        <path d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                    </svg> Add Vacancy
                </a>
                <a href="{{ route('admin.view.companies') }}" class="btn btn-secondary mr-1.5 pb-3.5 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 inline-block mb-0.5">
                        <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                    </svg> View Companies
                </a>
            </div>
        </div>
    @endalladmin
    <section class="flex items-center justify-center space-x-2" x-data="{ vacancy: null, loading: false }">
        <!-- Card Grid -->
        <div class="bg-gray-300 p-6 lg:p-8 rounded-lg lg:rounded-xl w-full lg:w-full">
            <div class="max-w-full mx-auto h-[calc(2.9*10rem)] lg:h-[calc(3.8*10rem)] overflow-y-auto pr-2">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($vacancies as $vacancy)
                        @alladmin
                            <button type="button" class="cards group bg-gray-100 hover:bg-white border border-gray-300 cursor-pointer p-4 rounded-lg lg:rounded-xl shadow-sm text-center transition" 
                            @click="loading = true; 
                            fetch('{{ route('admin.vacancy.api', $vacancy->id) }}').then(res => res.json()).then(data => { vacancy = data; loading = false; })">
                                <!-- Company Logo -->
                                <div class="flex items-center justify-center mb-4">
                                    <img src="{{ asset('storage/' . $vacancy->company->logo_url) }}" alt="{{ $vacancy->company->name }}" class="h-full max-h-12 object-contain">
                                </div>
                                <!-- Company Name -->
                                <h3 class="font-semibold text-md text-gray-800 truncate">{{ $vacancy->company->name }}</h3>
                                <!-- Job Count -->
                                @if ($vacancy->no_of_vacancies != null)
                                    <span class="text-sm text-gray-500 mt-1">{{ $vacancy->no_of_vacancies }} vacancies</span>
                                @else
                                    <span class="text-sm text-gray-500 mt-1">Not specified</span>
                                @endif
                            </button>
                        @endalladmin
                        @user
                            <button type="button" class="cards group bg-gray-100 hover:bg-white border border-gray-300 cursor-pointer p-4 rounded-lg lg:rounded-xl shadow-sm text-center transition" 
                            @click="loading = true; 
                            fetch('{{ route('vacancy.api', $vacancy->id) }}').then(res => res.json()).then(data => { vacancy = data; loading = false; })">
                                <!-- Company Logo -->
                                <div class="flex items-center justify-center mb-4">
                                    <img src="{{ asset('storage/' . $vacancy->company->logo_url) }}" alt="{{ $vacancy->company->name }}" class="h-full max-h-12 object-contain">
                                </div>
                                <!-- Company Name -->
                                <h3 class="font-semibold text-md text-gray-800 truncate">{{ $vacancy->company->name }}</h3>
                                <!-- Job Count -->
                                @if ($vacancy->no_of_vacancies != null)
                                    <span class="text-sm text-gray-500 mt-1">{{ $vacancy->no_of_vacancies }} vacancies</span>
                                @else
                                    <span class="text-sm text-gray-500 mt-1">Not specified</span>
                                @endif
                            </button>
                        @enduser
                        @guest
                            <button type="button" class="cards group bg-gray-100 hover:bg-white border border-gray-300 cursor-pointer p-4 rounded-lg lg:rounded-xl shadow-sm text-center transition" 
                            @click="loading = true; 
                            fetch('{{ route('vacancy.api', $vacancy->id) }}').then(res => res.json()).then(data => { vacancy = data; loading = false; })">
                                <!-- Company Logo -->
                                <div class="flex items-center justify-center mb-4">
                                    <img src="{{ asset('storage/' . $vacancy->company->logo_url) }}" alt="{{ $vacancy->company->name }}" class="h-full max-h-12 object-contain">
                                </div>
                                <!-- Company Name -->
                                <h3 class="font-semibold text-md text-gray-800 truncate">{{ $vacancy->company->name }}</h3>
                                <!-- Job Count -->
                                @if ($vacancy->no_of_vacancies != null)
                                    <span class="text-sm text-gray-500 mt-1">{{ $vacancy->no_of_vacancies }} vacancies</span>
                                @else
                                    <span class="text-sm text-gray-500 mt-1">Not specified</span>
                                @endif
                            </button>
                        @endguest
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Vacancy Details -->
        <div class="bg-gray-100 border border-gray-400 hidden lg:block p-8 rounded-xl shadow-md w-full">
            <div class="h-[calc(3.8*10rem)] max-w-full mx-auto overflow-y-auto">
                <!-- Loading Spinner -->
                <template x-if="loading">
                    <div class="flex items-center justify-center h-64">
                        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </div>
                    <p class="italic text-gray-400">Loading vacancy details...</p>
                </template>
                <!-- Details -->
                <template x-if="vacancy && !loading">
                    <div>
                        <!-- Company Logo -->
                        <div class="flex items-center space-x-4 mb-6">
                            <img :src="'{{ url('/storage') }}/' + vacancy.company.logo_url || '{{ asset('images/logo_default.png') }}'" 
                            :alt="vacancy.company.name + ' Logo'" class="max-w-24 w-full object-contain">
                            <div>
                                <h3 class="font-semibold text-3xl text-gray-900" x-text="vacancy.company.name"></h3>
                                <span class="text-lg text-gray-500" x-text="vacancy.no_of_vacancies + ' vacancies'"></span>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="my-4">
                            <dl>
                                <dt>Contact Details: </dt>
                                <dd class="text-gray-600" x-text="vacancy.company.contact_details ?? 'N/A'"></dd>
                                <dt>Vacancies: </dt>
                                <dd class="text-gray-600" x-text="vacancy.vacancies ?? 'N/A'"></dd>
                                <dt>Deployment Location: </dt>
                                <dd class="text-gray-600" x-text="vacancy.deployment_location ?? 'N/A'"></dd>
                            </dl>
                        </div>
                        <div class="my-4">
                            <button type="button" onclick="collapsibleDetails(this)" class="collapsible rounded-lg">More details</button>
                            <div class="content hidden rounded-lg">
                                <dl>
                                    <dt>Request Date: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.company.request_date ?? 'N/A'"></dd>
                                    <dt>Sector: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.sector ?? 'N/A'"></dd>
                                    <dt>Related Qualifications: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.related_qualifications ?? 'N/A'"></dd>
                                    <dt>Job Titles: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.job_titles ?? 'N/A'"></dd>
                                    <dt>TR Qualifications: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.tr_qualifications ?? 'N/A'"></dd>
                                    <dt>Number of Referred: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.no_of_referred ?? 'N/A'"></dd>
                                    <dt>Number of Hired: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.no_of_hired ?? 'N/A'"></dd>
                                    <dt>Remarks: </dt>
                                    <dd class="text-gray-600" x-text="vacancy.remarks ?? 'N/A'"></dd>
                                    <dt>Attachment Link: </dt>
                                    <a :href="vacancy.attachment_link" class="text-blue-700 underline">
                                        <dd x-text="vacancy.attachment_link ?? 'N/A'"></dd>
                                    </a>
                                </dl>
                            </div>
                        </div>
                        <!-- Link to Jobs -->
                        <div class="mt-6 hidden">
                            <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                View All Jobs
                            </a>
                        </div>
                    </div>
                </template>
                <!-- Placeholder when no company is selected -->
                <template x-if="!vacancy && !loading">
                    <div class="text-xl text-gray-500">
                        <p>Select a company to see details</p>
                    </div>
                </template>
            </div>
        </div>
    </section>
    
    <script>
        function collapsibleDetails(collapsible) {
            collapsible.classList.toggle("active");
            let content = collapsible.nextElementSibling;

            if (content.style.display === "block") {
                content.style.display = "none";
            }
            else {
                content.style.display = "block";
            }
        }
    </script>
</x-layout>