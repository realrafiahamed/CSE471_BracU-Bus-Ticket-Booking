<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-4xl mx-auto p-6">

    <a href="{{ route('admin.students.index') }}"
       class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition mb-6">
        Back to Dashboard
    </a>

    <div class="bg-white shadow-2xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-blue-700 mb-6">Edit Student</h1>

        <form action="{{ route('admin.students.update', $student->user_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold">First Name</label>
                    <input type="text" name="first_name" value="{{ $student->first_name }}" 
                           class="w-full border px-4 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block font-semibold">Last Name</label>
                    <input type="text" name="last_name" value="{{ $student->last_name }}" 
                           class="w-full border px-4 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" value="{{ $student->email }}" 
                           class="w-full border px-4 py-2 rounded-lg">
                </div>

                <div>
                    <label class="block font-semibold">Department</label>
                    <input type="text" name="department" value="{{ $student->department }}" 
                           class="w-full border px-4 py-2 rounded-lg">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" 
                        class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700 transition">
                    Update Student
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>


