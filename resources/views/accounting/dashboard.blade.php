<x-accounting_sidebar>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="m-4 font-bold text-4xl">
        <h2>Dashboard</h2>
    </div>

    <div class="m-4 grid grid-cols-1 gap-6">
        <!-- Student Portal Status Toggle -->
        <div class="card bg-white shadow-lg">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Student Portal Status</h2>
                        <p class="text-sm text-gray-500">Toggle to enable or disable student portal access</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span id="student-portal-status-label" class="badge {{ $studentPortalStatus === 'on' ? 'badge-success' : 'badge-error' }} badge-lg">
                            {{ ucfirst($studentPortalStatus) }}
                        </span>
                        <input type="checkbox" 
                               id="student-portal-toggle" 
                               class="toggle toggle-success toggle-lg" 
                               {{ $studentPortalStatus === 'on' ? 'checked' : '' }}
                               onchange="toggleStudentPortalStatus()" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function toggleStudentPortalStatus() {
            const toggle = document.getElementById('student-portal-toggle');
            const label = document.getElementById('student-portal-status-label');
            
            try {
                const response = await fetch('{{ route("accounting.api.student-portal-status.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                });
                
                const data = await response.json();
                
                // Update the label
                label.textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                label.className = data.is_on 
                    ? 'badge badge-success badge-lg' 
                    : 'badge badge-error badge-lg';
                    
            } catch (error) {
                console.error('Error toggling student portal status:', error);
                // Revert toggle if error
                toggle.checked = !toggle.checked;
            }
        }
    </script>

</x-accounting_sidebar>
