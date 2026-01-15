@section('title', 'E-TRAK - Create a record')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/table-of-graduates/create-record.js'])
@endsection

@section('main', 'Create Graduate Record')

@php
    $extension_names = ["Sr.", "Jr.", "III"];
    $sectors = [
        "Agriculture", "ALT", "Construction", "Electrical and Electronics", "Garments", "Health", "HVAC/R", "ICT", "Marine", 
        "Metals and Engineering", "Others", "Processed Foods and Beverages", "SCDOS", "Tourism", "TVET", "Visual Arts", "Wholesale"
    ];
    $districts = [
        "CaMaNaVa", "Manila", "MuntiParLasTaPat", "PaMaMariSan", "Pasay-Makati", "Quezon City"
    ];
    $cities = [
        "Caloocan City", "Malabon City", "Navotas City", "Valenzuela City", "Manila", 
        "Las Piñas City", "Muntinlupa City", "Parañaque City", "Pateros", "Taguig City", 
        "Mandaluyong City", "Marikina City", "Pasig City", "San Juan City", 
        "Makati City", "Pasay City", "Quezon City"
    ];
    $scholarship_types = [
        "STEP", "TWSP", "PESFA", "TTSP", "UAQTEA", "TSUPER Iskolar"
    ];
    $graduation_years = ["2023", "2024", "2025"];
    $allocations = ["FY 2023", "FY 2024", "FY 2025"];
@endphp

<x-layout>
    <div class="mb-5">
        <a href="{{ route('admin.table-of-graduates') }}" class="btn btn-secondary">Go Back</a>
    </div>
    <div class="bg-white border border-gray-300 mx-auto p-8 rounded-lg shadow-md">
        @if ($errors->any())
            <ul class="px-3 py-2 bg-red-400 rounded-md mb-5">
                @foreach ($errors->all() as $error)
                    <li class="text-md text-white">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('admin.create-record') }}" method="POST" class="space-y-6">
            @csrf
            {{-- FULL NAME --}}
            <div>
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-input" value="{{ old('last_name') }}" autofocus />
            </div>
            <div>
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-input" value="{{ old('first_name') }}" />
            </div>
            <div>
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" class="form-input" value="{{ old('middle_name') }}" />
            </div>
            <div class="mb-10">
                <label for="extension_name" class="form-label">Extension Name</label>
                <input type="text" name="extension_name" id="extension_name" class="form-input" value="{{ old('extension_name') }}" />
            </div>
            {{-- INITIAL DATA --}}
            <div>
                <label class="form-label">Sex</label>
                <div class="mt-2 space-y-2">
                    <label for="male" class="flex items-center">
                        <input type="radio" name="sex" id="male" value="Male" class="form-radio" {{ old('sex') == 'Male' ? 'checked' : '' }} />
                        <span class="ml-2 text-gray-700">Male</span>
                    </label>
                    <label for="female" class="flex items-center">
                        <input type="radio" name="sex" id="female" value="Female" class="form-radio" {{ old('sex') == 'Female' ? 'checked' : '' }} />
                        <span class="ml-2 text-gray-700">Female</span>
                    </label>
                </div>
            </div>
            <div>
                <label for="birthdate" class="form-label">Date of Birth</label>
                <input type="date" name="birthdate" id="birthdate" class="form-input" value="{{ old('birthdate') }}" />
            </div>
            <div>
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" class="form-input" value="{{ old('contact_number') }}" placeholder="0900-000-0000" />
            </div>
            <div>
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" rows="3" class="form-input">{{ old('address') }}</textarea>
            </div>
            <div>
                <label for="email" class="form-label">E-mail Address</label>
                <input type="email" name="email" id="email" class="form-input" value="{{ old('email') }}" placeholder="user@email.com" />
            </div>
            <div>
                <label for="sector" class="form-label">Sector</label>
                <select name="sector" id="sector" class="form-input">
                    <option value="">-- Select a sector --</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector }}" {{ old('sector') == $sector ? 'selected' : '' }}>{{ $sector }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="qualification_title" class="form-label">Qualification Title</label>
                <input type="text" name="qualification_title" id="qualification_title" class="form-input" value="{{ old('qualification_title') }}" />
            </div>
            <div>
                <label for="selectDistrict" class="form-label">District</label>
                <select name="district" id="selectDistrict" class="form-input">
                    <option value="">-- Select a district --</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district }}" {{ old('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="selectCity" class="form-label">City</label>
                <select name="city" id="selectCity" class="form-input">
                    <option value="">-- Select a city --</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" {{ old('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="scholarship_type" class="form-label">Type of Scholarship</label>
                <select name="scholarship_type" id="scholarship_type" class="form-input">
                    <option value="">-- Select a scholarship type --</option>
                    @foreach ($scholarship_types as $type)
                        <option value="{{ $type }}" {{ old('scholarship_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tvi" class="form-label">Name of TVI</label>
                <input type="text" name="tvi" id="tvi" class="form-input" value="{{ old('tvi') }}" />
            </div>
            <div>
                <label for="allocation" class="form-label">Year of Graduation</label>
                <select name="allocation" id="allocation" class="form-input">
                    <option value="">-- Select a graduation year --</option>
                    @for ($i = 0; $i < count($allocations); $i++)
                        <option value="{{ $allocations[$i] }}" {{ old('allocation') == $allocations[$i] ? 'selected' : '' }}>{{ $graduation_years[$i] }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex items-center justify-baseline">
                <button type="button" class="btn btn-primary rounded-lg mr-2" id="toggleCreate">Create</button>
            </div>
            {{-- Modal --}}
            <div class="relative z-10 hidden" id="confirmationModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Create Record</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Once this record is created, changes or updates for this information will never be possible. Do you confirm this action?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <input type="submit" name="create" class="btn-primary-modal" role="button" value="Confirm" />
                                <button type="button" id="dismissCreate" class="btn-secondary-modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>