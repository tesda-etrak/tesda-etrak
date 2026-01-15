@section('title', 'E-TRAK - List of Graduates')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 
        'resources/js/table-of-graduates/index.js'])
@endsection

@section('main', 'List of Graduates')

@php
    $categories = [
        "Full Name", 
        "Last Name", 
        "First Name", 
        "Middle Name", 
        "Extension Name", 
        "Status of Employment", 
        "Year of Graduation", 
        "Qualification Title", 
    ];
@endphp

<x-layout>
    <div class="flex items-center justify-baseline mb-4">
        @alladmin
            <form action="{{ route('admin.search-graduates') }}" method="GET" class="flex justify-baseline w-1/2">
                <input type="text" class="bg-white border px-2 py-1 rounded w-1/2" name="search" value="{{ $search }}" placeholder="Search record..." />
                <select name="search_category" class="bg-gray-300 border ml-1 px-2 py-1 rounded w-1/2">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option class="bg-gray-50" value="{{ $category }}" {{ $search_category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>
            <div class="ml-auto">
                <a href="{{ route('admin.create-record.view') }}" class="btn btn-primary mr-1.5 pb-3.5 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block mb-0.5 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg> Create Record
                </a>
                <button type="button" class="btn btn-danger" id="btnTruncate">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="inline-block mb-0.5 size-6">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                    </svg> Clear All Records
                </button>
            </div>
        @endalladmin
        @user
            <form action="{{ route('search-graduates') }}" method="GET" class="flex justify-baseline w-1/2">
                <input type="text" class="bg-white border px-2 py-1 rounded w-1/2" name="search" value="{{ $search }}" placeholder="Search record..." />
                <select name="search_category" class="bg-gray-300 border ml-1 px-2 py-1 rounded w-1/2">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option class="bg-gray-50" value="{{ $category }}" {{ $search_category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>
        @enduser
        @guest
            <form action="{{ route('search-graduates') }}" method="GET" class="flex justify-baseline w-1/2">
                <input type="text" class="bg-white border px-2 py-1 rounded w-1/2" name="search" value="{{ $search }}" placeholder="Search record..." />
                <select name="search_category" class="bg-gray-300 border ml-1 px-2 py-1 rounded w-1/2">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option class="bg-gray-50" value="{{ $category }}" {{ $search_category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>
        @endguest
    </div>
    <div class="mb-4 overflow-x-auto rounded-lg shadow-md">
        <table class="border-collapse w-full">
            <thead class="leading-normal text-center text-sm uppercase">
                <tr class="bg-gray-400 text-white">
                    <th class="px-6 py-3 border-r">Last Name</th>
                    <th class="px-6 py-3 border-r">First Name</th>
                    <th class="px-6 py-3 border-r">Middle Name</th>
                    <th class="px-6 py-3 border-r">Ext.</th>
                    <th class="px-6 py-3 border-r">Qualification Title</th>
                    <th class="px-6 py-3 border-r">Year of Graduation</th>
                    <th class="px-6 py-3 border-r">Status of Employment</th>
                    @alladmin
                        <th class="px-6 py-3 border-r"></th>
                    @endalladmin
                </tr>
            </thead>
            <tbody class="leading-normal text-center text-md">
                @foreach ($graduates as $graduate)
                    @alladmin
                        <tr data-url="{{ route('admin.record-details', $graduate->id) }}" class="body-row border-b border-gray-300 hover:bg-blue-100">
                            <td class="px-6 py-3">{{ $graduate->last_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->first_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->middle_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->extension_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->qualification_title }}</td>
                            <td class="px-6 py-3">{{ $graduate->allocation }}</td>
                            <td class="px-6 py-3">{{ $graduate->employment_status }}</td>
                            <td class="px-6 py-3">
                                <div class="flex justify-center space-x-2">
                                    <select class="action-select bg-gray-500 text-white hover:bg-gray-600 border font-semibold px-2 py-1 rounded-md" data-id="{{ $graduate->id }}">
                                        <option value="" class="bg-gray-300 text-black">Actions</option>
                                        <option value="view" data-url="{{ route('admin.record-details', $graduate->id) }}" class="bg-gray-50 text-black">View</option>
                                        <option value="update" data-url="{{ route('admin.update-record.view', $graduate->id) }}" class="bg-gray-50 text-black">Update</option>
                                        <option value="delete" data-value="{{ $graduate->id }}" class="delete-button bg-red-200 text-red-600">Delete</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    @endalladmin
                    @user
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $graduate->last_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->first_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->middle_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->extension_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->qualification_title }}</td>
                            <td class="px-6 py-3">{{ $graduate->allocation }}</td>
                            <td class="px-6 py-3">{{ $graduate->employment_status }}</td>
                        </tr>
                    @enduser
                    @guest
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $graduate->last_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->first_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->middle_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->extension_name }}</td>
                            <td class="px-6 py-4">{{ $graduate->qualification_title }}</td>
                            <td class="px-6 py-4">{{ $graduate->allocation }}</td>
                            <td class="px-6 py-4">{{ $graduate->employment_status }}</td>
                        </tr>
                    @endguest
                @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $graduates->withQueryString()->links('pagination::tailwind') }}</div>
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
    <div class="relative z-10 hidden" id="truncateModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Clear All Records</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to clear all existing records here? All records will be permanently removed and this action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('admin.truncate-graduates') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="bg-gray-50 px-4 py-3 lg:hidden">
                            <input type="submit" name="delete_all" class="btn-danger-modal" role="button" value="Clear All Records" />
                            <button type="button" id="cancelTruncate" class="btn-secondary-modal">Cancel</button>
                        </div>
                        <div class="bg-gray-50 hidden lg:flex flex-row-reverse px-6 py-3">
                            <input type="submit" name="delete_all" class="btn-danger-modal" role="button" value="Clear All Records" />
                            <button type="button" id="cancelTruncate_desktop" class="btn-secondary-modal mx-2">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>