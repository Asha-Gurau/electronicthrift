@extends('layouts.master')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-sky-100 flex items-center justify-center p-6">
    <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg flex flex-col md:flex-row">
        <!-- Photo Section -->
        <div class="w-1/2 flex items-center justify-center bg-sky-100">
            <img src="{{ asset('image/Naruto.png') }}" alt="Registration Illustration" class="w-full h-full">
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-6">
            <h2 class="text-3xl font-bold text-sky-800 text-center mb-6">Register</h2>
            <form id="registrationForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4" onsubmit="return validateForm()">
                @csrf

                <!-- Profile Picture -->
                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture"
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
                    @error('profile_picture')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    @error('phone')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <div class="flex space-x-4 mt-1">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="male" class="text-sky-500 focus:ring-sky-500" required>
                            <span class="ml-2 text-gray-700">Male</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="female" class="text-sky-500 focus:ring-sky-500" required>
                            <span class="ml-2 text-gray-700">Female</span>
                        </label>
                    </div>
                    @error('gender')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    @error('password_confirmation')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Forgot Password -->
                <div class="text-right">
                    <a href="{{ route('password.request') }}" class="text-sm text-sky-500 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-sky-500 text-white py-2 px-4 rounded-lg shadow hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 transition">
                        Register
                    </button>
                </div>

                <!-- Already Have an Account -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">Already have an account?
                        <a href="{{ route('login') }}" class="text-sky-500 hover:underline">Log in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const genderInputs = document.getElementsByName('gender');

        let valid = true;

        // Clear previous error messages
        const errorMessages = document.querySelectorAll('.text-red-500');
        errorMessages.forEach((msg) => msg.textContent = '');

        // Validate Full Name
        if (nameInput.value.trim() === '' || !/^[a-zA-Z\s]+$/.test(nameInput.value.trim())) {
            valid = false;
            const errorMessage = document.createElement('span');
            errorMessage.className = 'text-sm text-red-500';
            errorMessage.textContent = 'Full Name is required and must contain only letters.';
            nameInput.parentElement.appendChild(errorMessage);
        }

        // Validate Email
        // if (!/\S+@\S+\.\S+/.test(emailInput.value)) {
        //     valid = false;
        //     const errorMessage = document.createElement('span');
        //     errorMessage.className = 'text-sm text-red-500';
        //     errorMessage.textContent = 'Please enter a valid email address.';
        //     emailInput.parentElement.appendChild(errorMessage);
        // }





//validate email
        if (!/^[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(emailInput.value)) {
    valid = false;
    const errorMessage = document.createElement('span');
    errorMessage.className = 'text-sm text-red-500';
    errorMessage.textContent = 'Please enter a valid email address.';
    emailInput.parentElement.appendChild(errorMessage);
}

        // Validate Phone Number
        const phonePattern = /^(97|98)\d{8}$/;
        if (!phonePattern.test(phoneInput.value)) {
            valid = false;
            const errorMessage = document.createElement('span');
            errorMessage.className = 'text-sm text-red-500';
            errorMessage.textContent = 'The phone number must start with 97 or 98 and be exactly 10 digits.';
            phoneInput.parentElement.appendChild(errorMessage);
        }

        // Validate Gender
        const genderSelected = Array.from(genderInputs).some(input => input.checked);
        if (!genderSelected) {
            valid = false;
            const errorMessage = document.createElement('span');
            errorMessage.className = 'text-sm text-red-500';
            errorMessage.textContent = 'Please select a gender.';
            genderInputs[0].parentElement.appendChild(errorMessage);
        }

        // Validate Password
        if (passwordInput.value.length < 8 || !/(?=.*[a-zA-Z])(?=.*\d)/.test(passwordInput.value)) {
            valid = false;
            const errorMessage = document.createElement('span');
            errorMessage.className = 'text-sm text-red-500';
            errorMessage.textContent = 'Password must be at least 8 characters long and contain at least one letter and one number.';
            passwordInput.parentElement.appendChild(errorMessage);
        }

        // Validate Confirm Password
        if (passwordConfirmInput.value !== passwordInput.value) {
            valid = false;
            const errorMessage = document.createElement('span');
            errorMessage.className = 'text-sm text-red-500';
            errorMessage.textContent = 'Passwords do not match.';
            passwordConfirmInput.parentElement.appendChild(errorMessage);
        }

        return valid;
    }
</script>
@endsection
