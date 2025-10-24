    <form method="POST" action="{{ route('customer.book_trip_package.store') }}" id="bookingForm">
        @csrf
        <input type="hidden" name="package_id" value="{{ $package->id }}">
        <input type="hidden" id="packagePrice" value="{{ $package->price }}">

        @if(session('success'))
            <div x-data x-init="Swal.fire({
                icon: 'success',
                title: 'Success',
                text: @json(session('success')),
                confirmButtonColor: '#14b8a6'
            })"></div>
        @endif

        <div class="space-y-6">
            <!-- Full Name Field -->
            <div>
                <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 text-teal-500"></i>Full Name
                </label>
                <input type="text"
                       name="full_name"
                       id="full_name"
                       value="{{ old('full_name') }}"
                       placeholder="Enter your full name"
                       pattern="[A-Za-z\s]{2,}"
                       title="Please enter a valid name (letters and spaces only, minimum 2 characters)"
                       class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-300"
                       required>
                @error('full_name')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2 text-teal-500"></i>Email Address
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email') }}"
                       placeholder="Enter your email address"
                       class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-300"
                       required>
                @error('email')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Phone Number Field -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-phone mr-2 text-teal-500"></i>Phone Number
                </label>
                <input type="tel"
                       name="phone"
                       id="phone"
                       value="{{ old('phone') }}"
                       placeholder="e.g., 09123456789 or +639123456789"
                       pattern="[\+]?[0-9\s\-\(\)]{10,15}"
                       title="Please enter a valid phone number (10-15 digits)"
                       class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-300"
                       required>
                @error('phone')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Number of Travelers Field -->
            <div>
                <label for="participants" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-users mr-2 text-teal-500"></i>Number of Travelers
                </label>
                <input type="number"
                       name="participants"
                       id="participants"
                       value="{{ old('participants', 1) }}"
                       placeholder="Enter number of travelers"
                       min="1"
                       max="{{ $package->max_participants ?? 100 }}"
                       class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-300"
                       required>
                <p class="text-gray-500 text-xs mt-1">Minimum: 1, Maximum: {{ $package->max_participants ?? 100 }} travelers</p>
                @error('participants')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Travel Dates Field -->
            <div>
                <label for="travel_date" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt mr-2 text-teal-500"></i>Travel Dates
                </label>
                <input type="text"
                       name="travel_date"
                       id="travel_date"
                       value="{{ old('travel_date') }}"
                       placeholder="Select your travel dates"
                       readonly
                       class="w-full border border-gray-300 rounded-xl py-3 px-4 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-300 bg-white cursor-pointer"
                       required>
                @error('travel_date')
                    <p class="text-red-600 text-sm mt-1 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- TOTAL PRICE -->
        <div class="border-t border-gray-200 pt-4 mt-6 flex justify-between items-center">
            <span class="text-sm font-semibold text-gray-700">Total:</span>
            <p class="text-xl font-bold text-teal-600">
                ₱<span id="totalPrice">{{ number_format($package->price, 2) }}</span>
            </p>
        </div>

        <!-- SUBMIT -->
        <button type="submit"
                class="w-full mt-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 text-white font-semibold rounded-xl shadow-md hover:opacity-90 transition">
            <i class="fas fa-paper-plane mr-2"></i> Submit Booking
        </button>
    </form>


<!-- Flatpickr and SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_green.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const participantsInput = document.getElementById('participants');
    const totalDisplay = document.getElementById('totalPrice');
    const pricePerPerson = parseFloat(document.getElementById('packagePrice').value);
    const fullNameInput = document.getElementById('full_name');
    const phoneInput = document.getElementById('phone');

    const packageDurationText = @json($package->duration);
    const packageDuration = parseInt(packageDurationText);

    // Phone number validation and formatting
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
        
        // Format Philippine phone numbers
        if (value.length > 0) {
            if (value.startsWith('0')) {
                // Format: 0912 345 6789
                if (value.length > 4) {
                    value = value.substring(0, 4) + ' ' + value.substring(4, 7) + ' ' + value.substring(7, 11);
                } else if (value.length > 1) {
                    value = value.substring(0, 4) + ' ' + value.substring(4);
                }
            } else if (value.startsWith('63')) {
                // Format: +63 912 345 6789
                value = '+63 ' + value.substring(2, 5) + ' ' + value.substring(5, 8) + ' ' + value.substring(8, 12);
            }
        }
        
        e.target.value = value;
    });

    // Full name validation - only letters and spaces
    fullNameInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^A-Za-z\s]/g, ''); // Only allow letters and spaces
        e.target.value = value;
    });

    // Participants input validation
    participantsInput.addEventListener('input', () => {
        let value = parseInt(participantsInput.value) || 1;
        const max = parseInt(participantsInput.getAttribute('max') || 100);
        
        // Ensure value is within bounds
        if (value < 1) value = 1;
        if (value > max) value = max;
        
        participantsInput.value = value;
        
        // Update total price
        const total = value * pricePerPerson;
        totalDisplay.textContent = total.toLocaleString('en-PH', { minimumFractionDigits: 2 });
    });

    // Initialize total price
    participantsInput.dispatchEvent(new Event('input'));

    flatpickr("#travel_date", {
        mode: "range",
        dateFormat: "d/m/Y",
        minDate: "today",
        disableMobile: true,
        locale: { firstDayOfWeek: 1 },
        onClose: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                const diffDays = Math.round((selectedDates[1] - selectedDates[0]) / (1000 * 60 * 60 * 24)) + 1;
                if (diffDays > packageDuration) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Selection',
                        text: `This package is only valid for ${packageDuration} days.`,
                        confirmButtonColor: '#14b8a6'
                    });
                    instance.clear();
                }
            }
        }
    });

    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            // Validate full name
            const fullName = fullNameInput.value.trim();
            if (fullName.length < 2) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Name',
                    text: 'Please enter a valid full name (at least 2 characters).',
                    confirmButtonColor: '#14b8a6'
                });
                fullNameInput.focus();
                return;
            }

            // Validate phone number
            const phone = phoneInput.value.replace(/\D/g, ''); // Remove formatting
            if (phone.length < 10 || phone.length > 15) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Phone Number',
                    text: 'Please enter a valid phone number (10-15 digits).',
                    confirmButtonColor: '#14b8a6'
                });
                phoneInput.focus();
                return;
            }

            // Validate participants
            const pax = parseInt(participantsInput.value || 1);
            const max = parseInt(participantsInput.getAttribute('max') || 100);
            if (pax < 1 || pax > max) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Number of Travelers',
                    text: `Please enter between 1 and ${max} travelers.`,
                    confirmButtonColor: '#14b8a6'
                });
                participantsInput.focus();
                return;
            }

            // Validate travel dates
            const travelDate = document.getElementById('travel_date').value;
            if (!travelDate) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Travel Dates Required',
                    text: 'Please select your travel dates.',
                    confirmButtonColor: '#14b8a6'
                });
                return;
            }

            const submitBtn = bookingForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        });
    }
});
</script>
