@section('title', 'E-TRAK - Google Sheets Data')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/via-google-sheets/index.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('main', 'Google Sheets Data')

<x-layout>
    <div class="mb-4">
        <span class="text-3xl font-semibold underline">List of Graduates</span>
        <div class="my-4">
            <form action="{{ route('import.graduates') }}" method="GET" class="inline-block">
                <input type="submit" value="Import Graduates" class="btn btn-primary" />
            </form>
            @auth
                <a href="https://docs.google.com/spreadsheets/d/100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q/edit?gid=601902906#gid=601902906" 
                target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3.5 inline-block mb-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            @endauth
        </div>
        <div class="my-4">
            <form action="{{ route('export.graduates') }}" method="GET" class="inline-block">
                <input type="submit" value="Export Graduates" class="btn btn-secondary" />
            </form>
            @auth
                <a href="https://docs.google.com/spreadsheets/d/1-PlAbP1Y0dgqUEmblx3atGrjkkPWkOxrTE1qglkwfvM/edit?gid=765566487#gid=765566487" 
                target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3.5 inline-block mb-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>
    <div class="mb-4">
        <span class="text-3xl font-semibold underline">Job Vacancies</span>
        <div class="my-4">
            <form action="{{ route('import.vacancies') }}" method="GET" class="inline-block">
                <input type="submit" value="Import Vacancies" class="btn btn-primary" />
            </form>
            @auth
                <a href="https://docs.google.com/spreadsheets/d/100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q/edit?gid=250953884#gid=250953884" 
                target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3.5 inline-block mb-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </a>
            @endauth
        </div>
    </div>
</x-layout>