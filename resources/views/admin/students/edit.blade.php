<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-4xl mx-auto p-6">

    
    <a href="{{ url('/admin/students') }}"
       class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" class="w-5 h-5 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 19l-7-7 7-7" />
        </svg>
        Back to Dashboard
    </a>

    <div class="bg-white shadow rounded-xl p-6 mt-4">
        <h1 class="text-2xl font-bold mb-4 text-blue-700">Edit Student</h1>

        
        <form action="{{ route('admin.students.update', $student->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Name</label>
                <input type="text" name="name" value="{{ $student->name }}"
                       class="w-full border px-4 py-2 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Student ID</label>
                <input type="text" name="student_id" value="{{ $student->student_id }}"
                       class="w-full border px-4 py-2 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ $student->email }}"
                       class="w-full border px-4 py-2 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Department</label>
                <input type="text" name="department" value="{{ $student->department }}"
                       class="w-full border px-4 py-2 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Status</label>
                <select name="status"
                        class="w-full border px-4 py-2 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700 transition">
                Save Changes
            </button>
        </form>
    </div>

</div>

</body>
</html>

