<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 font-sans">

<div class="min-h-screen flex items-center justify-center p-6">
    
    <div class="bg-white shadow-2xl rounded-2xl w-full max-w-7xl p-8">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-blue-700">Admin Dashboard</h1>
            <div class="flex items-center space-x-4">
                <button id="sendNotificationBtn" 
                        class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow hover:bg-blue-700 transition-all">
                    Send Notification
                </button>
                <div class="bg-blue-100 px-4 py-2 rounded-full shadow font-semibold text-blue-700">
                    Total Students: <span id="totalStudents">0</span>
                </div>
                <a href="{{ route('admin.profile') }}" class="bg-green-600 text-white px-4 py-2 rounded-xl shadow hover:bg-green-700 transition-all">
                    My Profile
                </a>
                <a href="{{ route('admin.logout') }}" class="bg-red-600 text-white px-4 py-2 rounded-xl shadow hover:bg-red-700 transition-all">
                    Logout
                </a>

            </div>
        </div>

        
        <div class="relative flex mb-6 items-center space-x-3">
            <input
                type="text"
                id="searchInput"
                placeholder="Search by name, email, or student ID"
                class="border px-4 py-2 rounded-xl w-96 shadow focus:outline-none focus:ring-2 focus:ring-blue-400"
                autocomplete="off"
            />
            <div id="autocomplete" 
                 class="absolute top-full left-0 w-96 bg-white border rounded shadow mt-1 max-h-48 overflow-y-auto hidden z-50"></div>
        </div>

        <!-- Students Table -->
        <div class="overflow-x-auto rounded-xl shadow-lg">
            <table class="w-full border-collapse text-gray-700">
                <thead class="bg-gradient-to-r from-blue-700 via-purple-700 to-pink-700 text-white">
                    <tr>
                        <th class="border p-3 text-left">Name</th>
                        <th class="border p-3 text-left">Student ID</th>
                        <th class="border p-3 text-left">Email</th>
                        <th class="border p-3 text-left">Status</th>
                        <th class="border p-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="studentsTable">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const tableBody = document.getElementById('studentsTable');
    const totalStudentsSpan = document.getElementById('totalStudents');
    const sendNotificationBtn = document.getElementById('sendNotificationBtn');
    const searchInput = document.getElementById('searchInput');
    const autocomplete = document.getElementById('autocomplete');

    
    async function fetchStudents(search = '') {
        const response = await fetch(`/api/students?search=${search}`);
        const data = await response.json();

        tableBody.innerHTML = '';
        totalStudentsSpan.textContent = data.total || data.data.length;

        if (data.data.length === 0) {
            tableBody.innerHTML = `<tr><td class="border p-3 text-center" colspan="5">No students found</td></tr>`;
            return;
        }

        data.data.forEach((student, index) => {
            const row = document.createElement('tr');
            row.classList.add(index % 2 === 0 ? 'bg-gray-50' : 'bg-white', 'hover:bg-blue-50', 'transition-colors');

            row.innerHTML = `
                <td class="border p-3 font-medium">${student.name}</td>
                <td class="border p-3">${student.student_id}</td>
                <td class="border p-3">${student.email}</td>
                <td class="border p-3">
                    <span class="${student.status === 'active' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'}">
                        ${student.status.charAt(0).toUpperCase() + student.status.slice(1)}
                    </span>
                </td>
                <td class="border p-3">
                    <a href="/admin/students/${student.id}" class="text-blue-600 underline mr-2">View</a>
                    <a href="/admin/students/${student.id}/edit" class="text-green-600 underline">Edit</a>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    
    async function updateAutocomplete() {
        const search = searchInput.value.trim();
        if (!search) {
            autocomplete.classList.add('hidden');
            return;
        }

        const response = await fetch(`/api/students?search=${search}`);
        const data = await response.json();

        autocomplete.innerHTML = '';
        if (data.data.length === 0) {
            autocomplete.classList.add('hidden');
            return;
        }

        data.data.forEach(student => {
            const div = document.createElement('div');
            div.className = 'p-2 hover:bg-blue-100 cursor-pointer';
            div.textContent = student.name;
            div.addEventListener('click', () => {
                searchInput.value = student.name;
                autocomplete.classList.add('hidden');
                fetchStudents(student.name); 
            });
            autocomplete.appendChild(div);
        });
        autocomplete.classList.remove('hidden');
    }

    
    searchInput.addEventListener('input', () => {
        fetchStudents(searchInput.value);
        updateAutocomplete();
    });

    
    document.addEventListener('click', (e) => {
        if (!autocomplete.contains(e.target) && e.target !== searchInput) {
            autocomplete.classList.add('hidden');
        }
    });

    sendNotificationBtn.addEventListener('click', () => {
        alert('Send notification functionality not implemented yet.');
    });

    
    fetchStudents();
</script>

</body>
</html>
