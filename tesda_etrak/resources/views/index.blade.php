@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <section class="mb-20 space-y-8">
        <div class="text-center sm:flex sm:items-center sm:justify-start sm:mt-auto sm:text-start">
            <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="mx-auto w-3xs sm:mx-10">
            <div>
                <h3 class="text-4xl font-bold mb-2 sm:hidden">Welcome to E-TRAK</h3>
                <h1 class="mb-2 hidden sm:block">Welcome to E-TRAK</h1>
                <p class="text-xl sm:text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
            </div>
        </div>
        <video class="border rounded shadow-md sm:mx-auto sm:w-4xl" autoplay controls muted>
            <source src="{{ asset('videos/index.webm') }}" type="video/webm">
            <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
            <source src="{{ asset('videos/index.ogg') }}" type="video/ogg">
            Your browser does not support HTML video.
        </video>
        <section class="border-gray-200 border-4 flex sm:flex-col items-center justify-center sm:mx-24 p-6 rounded-2xl shadow-lg">
            <div class="mx-auto mb-16 space-y-20 sm:hidden">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-28 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-24 object-contain">
                </div>
            </div>
            <div class="mx-auto space-y-8 sm:hidden">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-28 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_dps-2025.png') }}" alt="DPS Registration 2025 Seal" class="w-40 object-contain">
                </div>
            </div>
            <div class="hidden sm:flex items-center justify-center space-x-48">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-48 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-48 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-48 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_dps-2025.png') }}" alt="DPS Registration 2025 Seal" class="w-48 object-contain">
                </div>
            </div>
        </section>
    </section>
</x-layout>