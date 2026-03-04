<x-student_portal_sidebar>

    <div class="m-4 font-bold text-4xl">
        <h2>Examination Permit</h2>
    </div>

    <div class="m-4">
        <div class="card bg-white shadow-lg">
            <div class="card-body">
                <h3 class="text-lg font-semibold mb-4">Your Examination Permit</h3>
                
                <div class="flex flex-col items-center justify-center py-8">
                    @if($student->account && $student->account->examination_permit)
                        <div class="text-center">
                            <p class="text-2xl font-bold text-success mb-4">{{ $student->account->examination_permit }}</p>
                            <p class="text-gray-500">Present this permit code during examinations.</p>
                        </div>
                    @else
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-16 text-gray-400 mb-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <p class="text-xl font-semibold text-gray-600 mb-2">-</p>
                            <p class="text-gray-500 text-center">
                                No examination permit has been generated yet.<br>
                                Please contact the accounting office.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-student_portal_sidebar>
