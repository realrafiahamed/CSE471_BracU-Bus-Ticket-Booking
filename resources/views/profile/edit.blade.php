@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-200 px-4">

    <div class="w-full max-w-3xl bg-white/80 backdrop-blur-xl shadow-xl rounded-3xl p-10 border border-white/40">

        <h1 class="text-3xl font-bold text-gray-900 text-center mb-8">
            Edit Profile
        </h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            {{-- ========================================= --}}
            {{--            AVATAR SECTION (TOP)             --}}
            {{-- ========================================= --}}

            <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Choose Avatar</h2>

            @php
                $avatars = [
                    'avatar1.png','avatar2.png','avatar3.png','avatar4.png','avatar5.png',
                    'avatar6.png','avatar7.png','avatar8.png','avatar9.png','avatar10.png'
                ];
            @endphp

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-6 justify-center mb-10">
                @foreach($avatars as $avatar)
                    <label class="flex flex-col items-center cursor-pointer">
                        <input type="radio" name="avatar" value="{{ $avatar }}" class="hidden peer"
                            @checked(auth()->user()->avatar == $avatar)>

                        <img src="{{ asset('avatars/' . $avatar) }}"
                             class="w-20 h-20 rounded-full shadow-md transition-transform transform 
                                    scale-100 hover:scale-110
                                    peer-checked:ring-4 peer-checked:ring-blue-500 peer-checked:scale-105">
                    </label>
                @endforeach
            </div>

            {{-- ========================================= --}}
            {{--          PROFILE INPUT FIELDS             --}}
            {{-- ========================================= --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="font-semibold text-gray-700">First Name</label>
                    <input type="text" name="first_name"
                           value="{{ old('first_name', auth()->user()->first_name) }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Last Name</label>
                    <input type="text" name="last_name"
                           value="{{ old('last_name', auth()->user()->last_name) }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Phone Number</label>
                    <input type="text" name="phone_no"
                           value="{{ old('phone_no', auth()->user()->phone_no) }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Student ID</label>
                    <input type="text" name="student_id"
                           value="{{ old('student_id', auth()->user()->student_id) }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-400" readonly>
                </div>

                <div>
                    <label class="font-semibold text-gray-700">Department</label>
                    <input type="text" name="department"
                           value="{{ old('department', auth()->user()->department) }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold text-gray-700">Default Pickup Location</label>
                    <select name="default_location"
                            class="w-full mt-1 px-4 py-3 rounded-xl border bg-white focus:ring-2 focus:ring-blue-400">
                        @php
                            $locations = ['Abdullahpur','Uttara','Mirpur','Dhanmondi','Gulshan','Bashundhara'];
                        @endphp
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}"
                                {{ auth()->user()->default_location == $loc ? 'selected' : '' }}>
                                {{ $loc }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- Save Button --}}
            <button
                class="mt-10 w-full bg-blue-600 text-white py-3 rounded-2xl font-semibold text-lg
                       hover:bg-blue-700 transition">
                Save Changes
            </button>

        </form>
    </div>

</div>

@endsection
