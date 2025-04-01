@if ($status == 'success')
    <div id="toast-default"
        class="flex items-center w-full max-w-xs p-4 bg-gray-200 rounded-lg shadow-sm text-gray-800 fixed top-5 right-5"
        role="alert">
        <i class="fi fi-ss-check-circle text-green-600 text-2xl"></i>
        <div class="ms-3 text-sm font-normal uppercase">{{ $message }}</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 text-gray-600 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#toast-default" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif

@if ($status == 'error')
    <div id="toast-error"
        class="flex items-center w-full max-w-xs p-4 bg-gray-200 rounded-lg shadow-sm text-gray-800 fixed top-5 right-5"
        role="alert">
        <i class="fi fi-ss-octagon-xmark text-red-600 text-2xl"></i>
        <div class="ms-3 text-sm font-normal uppercase">{{ $message }}</div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 text-gray-600 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#toast-error" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif
