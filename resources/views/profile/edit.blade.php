<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .card {
            background: #ffffff;
            width: 1200px;
            max-width: 95%;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            border: none;
        }

        h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            color: #1a202c;
        }

        .layout {
            display: flex;
            gap: 110px;
            align-items: start;
        }

        .form-section {
            flex: 1;
            max-width: 450px;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #4a5568;
            font-size: 15px;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background-color: #f7fafc;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
            outline: none;
        }

        .avatar-section {
            width: 450px;
            background: #f7fafc;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            align-self: start;
            margin-top: 40px; /* This moves the entire avatar box down to align with the First Name input */
        }

        .avatar-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .avatar-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #1a202c;
            width: 100%;
        }

        .avatar-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            width: 100%;
        }

        .avatar-grid input {
            display: none;
        }

        .avatar-grid img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .avatar-grid img:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .avatar-grid input:checked + img {
            border-color: #3182ce;
            box-shadow: 0 0 0 4px rgba(66, 153, 225, 0.2);
        }

        .actions {
            margin-top: 40px;
            text-align: center;
        }

        button {
            padding: 14px 30px;
            background: linear-gradient(135deg, #4299e1, #3182ce);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #3182ce, #2b6cb0);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(66, 153, 225, 0.3);
        }

        .error-message {
            color: #e53e3e;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }

        @media (max-width: 1000px) {
            .layout {
                flex-direction: column;
                gap: 30px;
            }

            .form-section {
                max-width: 100%;
            }

            .avatar-section {
                width: 100%;
                margin-top: 0; /* Reset margin on mobile for better flow */
            }
        }

        @media (max-width: 600px) {
            .card {
                padding: 30px;
            }

            h1 {
                font-size: 32px;
            }

            .avatar-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="card">

    <h1>Edit Profile</h1>

    @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="layout">

            <!-- LEFT: FORM -->
            <div class="form-section">

                <label>First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}">

                <label>Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}">

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}">

                <label>Phone</label>
                <input type="text" name="phone_no" value="{{ old('phone_no', $user->phone_no) }}">

                <label>Student ID</label>
                <input type="text" name="student_id" value="{{ old('student_id', $user->student_id) }}">

                <label>Department</label>
                <input type="text" name="department" value="{{ old('department', $user->department) }}">

                <label>Default Location</label>
                            <!-- Default Pickup Location Dropdown -->
            <select name="default_location" id="default_location" required>
                <option value="" disabled selected>Select Default PickUp Location</option>
                <option value="Abdullahpur">Abdullahpur</option>
                <option value="House Building">House Building</option>
                <option value="Azampur">Azampur</option>
                <option value="Jasimuddin">Jasimuddin</option>
                <option value="Airport">Airport</option>
                <option value="Kawla">Kawla</option>
                <option value="Khilkhet">Khilkhet</option>
                <option value="Biswa Road">Biswa Road</option>
                <option value="Shewrah">Shewrah</option>

                <option value="Mirpur Bangla College">Mirpur Bangla College</option>
                <option value="Dhaka Laboratory School and College">Dhaka Laboratory School & College</option>
                <option value="Sony Cinema Hall">Sony Cinema Hall</option>
                <option value="Mirpur College Gate (Mirpur 2)">Mirpur College Gate (Mirpur 2)</option>
                <option value="Swimming Federation Gate">Swimming Federation Gate</option>
                <option value="Popular Diagnostic Centre">Popular Diagnostic Centre</option>
                <option value="Pallabi Post Office">Pallabi Post Office</option>
                <option value="Mirpur 11.5">Mirpur 11.5</option>
                <option value="Mirpur Ceramics">Mirpur Ceramics</option>
                <option value="Mirpur DOHS Gate">Mirpur DOHS Gate</option>
                <option value="Pallabi Thana">Pallabi Thana</option>
                <option value="Kalshi Bus Stand">Kalshi Bus Stand</option>
                <option value="ECB Chattar">ECB Chattar</option>

                <option value="Mirpur 14 Bus Stand">Mirpur 14 Bus Stand</option>
                <option value="NAM Garden Officers Quarter">NAM Garden Officers Quarter</option>
                <option value="Adarsha High School">Adarsha High School</option>
                <option value="Al Helal Specialized Hospital">Al Helal Specialized Hospital</option>
                <option value="Kazipara">Kazipara</option>
                <option value="Shewrapara">Shewrapara</option>
                <option value="Taltola Bus Stand">Taltola Bus Stand</option>
                <option value="Shadhinata Tower">Shadhinata Tower</option>

                <option value="Jigatola Bus Stand">Jigatola Bus Stand</option>
                <option value="Shankar Bus Stand">Shankar Bus Stand</option>
                <option value="Meena Bazar">Meena Bazar</option>
                <option value="West end of Manik Mia Avenue">West end of Manik Mia Avenue</option>

                <option value="Azimpur Etimkhana Mour">Azimpur Etimkhana Mour</option>
                <option value="Azimpur Chowrasta">Azimpur Chowrasta</option>
                <option value="New Market">New Market</option>
                <option value="Happy Arcade Shopping Mall">Happy Arcade Shopping Mall</option>
                <option value="Dhanmondi Road No 7">Dhanmondi Road No 7</option>
                <option value="Kalabagan Krira Chokro">Kalabagan Krira Chokro</option>
                <option value="Sobhanbag">Sobhanbag</option>
                <option value="Khejur Bagan Mour">Khejur Bagan Mour</option>

                <option value="Doyaganj Mour">Doyaganj Mour</option>
                <option value="Ittefaq Mour">Ittefaq Mour</option>
                <option value="Mugda Foot Over-bridge">Mugda Foot Over-bridge</option>
                <option value="Boudhha Mandir">Boudhha Mandir</option>
                <option value="Bashabo">Bashabo</option>
                <option value="Khilgaon Police Fari">Khilgaon Police Fari</option>
                <option value="Khidmah Hospital">Khidmah Hospital</option>

                <option value="Baldha Garden">Baldha Garden</option>
                <option value="Motijheel">Motijheel</option>
                <option value="Arambagh">Arambagh</option>
                <option value="Fakirapool Mour">Fakirapool Mour</option>
                <option value="Purana Paltan">Purana Paltan</option>
                <option value="Kakrail Mour">Kakrail Mour</option>
                <option value="Shantinagar Mour">Shantinagar Mour</option>
                <option value="Malibagh Mour">Malibagh Mour</option>
                <option value="Mouchak Mour">Mouchak Mour</option>
                <option value="Moghbazar T&T Office">Moghbazar T&T Office</option>
                <option value="Moghbazar Mour">Moghbazar Mour</option>

                <option value="Shia Masjid (near Top Ten shop)">Shia Masjid</option>
                <option value="Opposite to Suchona Community Center">Suchona Community Center</option>
                <option value="Shampa Market">Shampa Market</option>
                <option value="Shyamoli (Bata Mour)">Shyamoli (Bata Mour)</option>
                <option value="Opposite to Shyamoli Cinema Hall">Shyamoli Cinema Hall</option>
                <option value="Agargaon Radio Office">Agargaon Radio Office</option>
                <option value="Opposite to Agargaon flower shops">Agargaon flower shops</option>

                <option value="In front of Bata Showroom (Opposite to Japan Garden City Main Gate)">Japan Garden City Main Gate</option>
                <option value="In front of Baitus Sujud Jame Mosque (Near Mohammadpur Bus Stand/Nurjahan Route)">Baitus Sujud Jame Mosque (Near Mohammadpur Bus Stand/Nurjahan Route)</option>
                <option value="Town Hall Supermarket (In front of Bikrampur Mistanna Bhandar)">Town Hall Supermarket (In front of Bikrampur Mistanna Bhandar)</option>
                <option value="Opposite to Asad Gate (Under Foot over Bridge)">Opposite to Asad Gate </option>
                <option value="Dhaka Dental College Hostel (Opposite to Sobhanbag Mosque)">Dhaka Dental College Hostel</option>
                <option value="New Model Mohumukhi High School (Opposite to Kalabagan Bus Counter)">New Model Mohumukhi High School (Opposite to Kalabagan Bus Counter)</option>
                <option value="Water Bhaban (Near Panthapath Mour)">Water Bhaban (Near Panthapath Mour)</option>

                <option value="Narayanganj Central Shaheed Minar (Chashara)">Narayanganj Central Shaheed Minar (Chashara)</option>
                <option value="Himaloy Chinese & Community Centre (opposite to Narayanganj Zila Parishad)">Himaloy Chinese & Community Centre</option>
                <option value="Shibu Market (in front of Dutch Bangla Bank)">Shibu Market </option>
                <option value="Jalkuri Bus Stand, Fatullah (in front of First Security Islami Bank)">Jalkuri Bus Stand, Fatullah</option>
                <option value="Bhuighar (near Darussunnah Islamia Kamil Madrasah)">Bhuighar</option>
                <option value="Signboard (near Islamia Eye Hospital)">Signboard (near Islamia Eye Hospital)</option>
                <option value="Shamsul Hoque School & College (under foot over-bridge)">Shamsul Hoque School & College </option>
                <option value="Sanarpar Bus Stand, Siddhirganj">Sanarpar Bus Stand, Siddhirganj</option>
                <option value="Madaninagar Fazil Madrasah, Siddhirganj (near foot over-bridge)">Madaninagar Fazil Madrasah, Siddhirganj </option>
                <option value="Khankaye Jame Masjid, Narayanganj (near foot over-bridge)">Khankaye Jame Masjid, Narayanganj </option>
                <option value="Opposite to Rani Mahal Cinema Hall, Demra">Opposite to Rani Mahal Cinema Hall, Demra</option>
                <option value="IFIC Bank Ltd (opposite to Sarulia Bazar)">IFIC Bank Ltd (opposite to Sarulia Bazar)</option>
                <option value="In front of Demra Ideal College">In front of Demra Ideal College</option>

                <option value="Ebenezer International School, Bashundhara R/A">Ebenezer International School, Bashundhara R/A</option>
                <option value="Block-F, Road No 08, Bashundhara R/A (opposite to IFIC Bank)">Block-F, Road No 08, Bashundhara R/A </option>
                <option value="In front of Aga Khan Academy, Bashundhara R/A">In front of Aga Khan Academy, Bashundhara R/A</option>
                <option value="Jamuna Future Park (Under foot over-bridge)">Jamuna Future Park </option>
            </select>

            </div>

            <!-- RIGHT: AVATARS -->
            <div class="avatar-section">
                <div class="avatar-content">
                    <h2>Choose Avatar</h2>

                    <div class="avatar-grid">
                        @for($i = 1; $i <= 10; $i++)
                            <label>
                                <input type="radio" name="avatar"
                                       value="avatar{{ $i }}.png"
                                       @checked($user->avatar == "avatar{$i}.png")>
                                <img src="/avatars/avatar{{ $i }}.png" alt="Avatar {{ $i }}">
                            </label>
                        @endfor
                    </div>
                </div>
            </div>

        </div>

        <div class="actions">
            <button type="submit">Save Changes</button>
        </div>

    </form>

</div>

</body>
</html>