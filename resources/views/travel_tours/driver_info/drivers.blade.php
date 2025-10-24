@extends('travel_tours.travel_layout')

@section('page-title', 'Drivers')

@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Drivers</h2>
        <button 
            id="openModalBtn" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition-all"
        >
            <i class="fa-solid fa-plus mr-2"></i> Add New Driver
        </button>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" 
                    x-model="searchQuery"
                    @input="filterTeam()"
                    placeholder="Search team members..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <select x-model="selectedStatus" 
                        @change="filterTeam()"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="busy">Busy</option>
                    <option value="off">Off Duty</option>
                </select>
            </div>
            <div>
                <button @click="resetFilters()" class="w-full px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Reset Filters
                </button>
            </div>
        </div>
    </div>
    <!-- Drivers Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Driver Information</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">License Details</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Verification</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">1</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">JD</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">John Doe</div>
                                    <div class="text-xs text-gray-500">+63 912 345 6789</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">DL23-12-123456</div>
                            <div class="text-xs text-gray-500">Expires: 12/2025</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full flex items-center gap-1">
                                    <i class="fa-solid fa-check-circle"></i>
                                    Verified
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Available</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-300 transform hover:scale-110" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-all duration-300 transform hover:scale-110" title="Edit Driver">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-300 transform hover:scale-110" title="Remove Driver">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Sample Unverified Driver -->
                    <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">2</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">MJ</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">Maria Johnson</div>
                                    <div class="text-xs text-gray-500">+63 923 456 7890</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">DL23-08-987654</div>
                            <div class="text-xs text-gray-500">Expires: 08/2026</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full flex items-center gap-1">
                                    <i class="fa-solid fa-exclamation-triangle"></i>
                                    Pending
                                </span>
                                <button class="p-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 transition" title="Re-verify License">
                                    <i class="fa-solid fa-sync-alt text-xs"></i>
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded-full">Off Duty</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <button class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-300 transform hover:scale-110" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-all duration-300 transform hover:scale-110" title="Edit Driver">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-300 transform hover:scale-110" title="Remove Driver">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ===========================
     ADD DRIVER MODAL
=========================== -->
<div id="addDriverModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-4 relative overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="flex justify-between items-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-user-plus text-white"></i>
                </div>
                <h3 class="text-xl font-bold">Add New Driver</h3>
            </div>
            <button id="closeModalBtn" class="text-white hover:text-gray-200 transition-colors duration-300 transform hover:scale-110">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <!-- Scrollable Form -->
        <div class="max-h-[70vh] overflow-y-auto px-8 py-6">
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <span class="font-semibold">Please fix the following errors:</span>
                    </div>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fa-solid fa-user mr-2 text-blue-500"></i>Full Name
                    </label>
                    <input type="text" name="name" required 
                           placeholder="Enter driver's full name"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fa-solid fa-id-card mr-2 text-blue-500"></i>Driver's License Number
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="license_no" 
                            id="licenseInput"
                            required
                            pattern="^[A-Z]{2}\d{2}-\d{2}-\d{6}$"
                            title="License number must be in format: XX##-##-###### (e.g., DL23-12-123456)"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                            placeholder="Enter license number (e.g., DL23-12-123456)"
                        >
                        <button 
                            type="button" 
                            id="verifyLicenseBtn"
                            class="absolute right-3 top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105"
                        >
                            <i class="fa-solid fa-search mr-1"></i>Verify
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Format: XX##-##-###### (e.g., DL23-12-123456)</p>
                    
                    <!-- License Verification Status -->
                    <div id="licenseStatus" class="mt-2 hidden">
                        <div id="verificationPending" class="hidden flex items-center gap-2 text-yellow-600">
                            <i class="fa-solid fa-spinner fa-spin"></i>
                            <span class="text-sm">Verifying license...</span>
                        </div>
                        <div id="verificationSuccess" class="hidden flex items-center gap-2 text-green-600">
                            <i class="fa-solid fa-check-circle"></i>
                            <span class="text-sm">License verified and valid</span>
                        </div>
                        <div id="verificationError" class="hidden flex items-center gap-2 text-red-600">
                            <i class="fa-solid fa-exclamation-triangle"></i>
                            <span class="text-sm" id="errorMessage">License not found or invalid</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fa-solid fa-phone mr-2 text-blue-500"></i>Contact Number
                    </label>
                    <input type="tel" name="contact" required 
                           placeholder="e.g., +63 912 345 6789"
                           pattern="[\+]?[0-9\s\-\(\)]{10,15}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                    <p class="text-xs text-gray-500 mt-1">Enter a valid Philippine phone number</p>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button 
                        type="button" 
                        id="cancelModalBtn"
                        class="px-6 py-3 text-gray-600 hover:text-gray-800 font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105"
                    >
                        <i class="fa-solid fa-save mr-2"></i>
                        Save Driver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ===========================
     MODAL SCRIPT
=========================== -->
<script>
    const modal = document.getElementById('addDriverModal');
    const modalContent = document.getElementById('modalContent');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const verifyLicenseBtn = document.getElementById('verifyLicenseBtn');
    const licenseInput = document.getElementById('licenseInput');
    const licenseStatus = document.getElementById('licenseStatus');
    const verificationPending = document.getElementById('verificationPending');
    const verificationSuccess = document.getElementById('verificationSuccess');
    const verificationError = document.getElementById('verificationError');
    const errorMessage = document.getElementById('errorMessage');

    // Modal functionality
    const openModal = () => {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Animate modal in
        setTimeout(() => {
            modalContent.style.transform = 'scale(1)';
            modalContent.style.opacity = '1';
        }, 10);
    };

    const closeModal = () => {
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetForm();
        }, 300);
    };

    const resetForm = () => {
        // Reset form fields
        document.querySelector('form').reset();
        
        // Hide license status
        licenseStatus.classList.add('hidden');
        verificationPending.classList.add('hidden');
        verificationSuccess.classList.add('hidden');
        verificationError.classList.add('hidden');
    };

    // License verification functionality
    const verifyLicense = async () => {
        const licenseNumber = licenseInput.value.trim();
        
        if (!licenseNumber) {
            showVerificationError('Please enter a license number');
            return;
        }

        // Show pending state
        showVerificationPending();

        try {
            // Simulate API call to verify license
            // In a real application, this would call your backend API
            const response = await simulateLicenseVerification(licenseNumber);
            
            if (response.valid) {
                showVerificationSuccess();
            } else {
                showVerificationError(response.message || 'License not found or invalid');
            }
        } catch (error) {
            showVerificationError('Verification failed. Please try again.');
        }
    };

    const simulateLicenseVerification = async (licenseNumber) => {
        // Simulate network delay
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        // Mock verification logic
        // In real implementation, this would check against LTO database
        const validLicenses = [
            'DL23-12-123456',
            'DL23-08-987654',
            'DL22-05-456789',
            'DL24-01-789012'
        ];

        if (validLicenses.includes(licenseNumber)) {
            return { valid: true };
        } else {
            return { 
                valid: false, 
                message: 'License not found in LTO database' 
            };
        }
    };

    const showVerificationPending = () => {
        licenseStatus.classList.remove('hidden');
        verificationPending.classList.remove('hidden');
        verificationSuccess.classList.add('hidden');
        verificationError.classList.add('hidden');
        
        verifyLicenseBtn.disabled = true;
        verifyLicenseBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i>Verifying...';
    };

    const showVerificationSuccess = () => {
        verificationPending.classList.add('hidden');
        verificationSuccess.classList.remove('hidden');
        verificationError.classList.add('hidden');
        
        verifyLicenseBtn.disabled = false;
        verifyLicenseBtn.innerHTML = '<i class="fa-solid fa-check mr-1"></i>Verified';
        verifyLicenseBtn.classList.add('bg-green-600', 'hover:bg-green-700');
        verifyLicenseBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
    };

    const showVerificationError = (message) => {
        verificationPending.classList.add('hidden');
        verificationSuccess.classList.add('hidden');
        verificationError.classList.remove('hidden');
        errorMessage.textContent = message;
        
        verifyLicenseBtn.disabled = false;
        verifyLicenseBtn.innerHTML = '<i class="fa-solid fa-search mr-1"></i>Verify';
        verifyLicenseBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
        verifyLicenseBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
    };

    // Event listeners
    openModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);
    cancelModalBtn.addEventListener('click', closeModal);
    verifyLicenseBtn.addEventListener('click', verifyLicense);

    // Close modal when clicking outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // License input formatting
    licenseInput.addEventListener('input', (e) => {
        let value = e.target.value.toUpperCase().replace(/[^A-Z0-9-]/g, '');
        
        // Format as XX##-##-######
        if (value.length > 2 && value[2] !== '-') {
            value = value.substring(0, 2) + '-' + value.substring(2);
        }
        if (value.length > 5 && value[5] !== '-') {
            value = value.substring(0, 5) + '-' + value.substring(5);
        }
        if (value.length > 12) {
            value = value.substring(0, 12);
        }
        
        e.target.value = value;
        
        // Reset verification status when license number changes
        if (licenseStatus && !licenseStatus.classList.contains('hidden')) {
            licenseStatus.classList.add('hidden');
            verificationPending.classList.add('hidden');
            verificationSuccess.classList.add('hidden');
            verificationError.classList.add('hidden');
            
            verifyLicenseBtn.disabled = false;
            verifyLicenseBtn.innerHTML = '<i class="fa-solid fa-search mr-1"></i>Verify';
            verifyLicenseBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
            verifyLicenseBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
        }
    });
</script>
@endsection
