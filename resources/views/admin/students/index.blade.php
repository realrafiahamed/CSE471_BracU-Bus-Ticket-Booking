<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 font-sans">

<div class="min-h-screen p-6">
    <div class="bg-white shadow-2xl rounded-2xl w-full p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-blue-700">Admin Dashboard</h1>

            <div class="flex items-center gap-4">
                <button id="sendNotificationBtn" class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                    Send Notification
                </button>

                <div class="bg-blue-100 px-4 py-2 rounded-full font-semibold text-blue-700">
                    Total Students: <span id="totalStudents">0</span>
                </div>


                <a href="{{ route('admin.profile') }}" class="bg-green-600 text-white px-4 py-2 rounded-xl">My Profile</a>
                <a href="{{ route('admin.logout') }}" class="bg-red-600 text-white px-4 py-2 rounded-xl">Logout</a>
            </div>
        </div>

        {{-- Search --}}
        <input id="searchInput" type="text"
               placeholder="Search by name / email / student id"
               class="border px-4 py-2 rounded-xl w-96 mb-6">

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-blue-700 text-white">
                    <tr>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Student ID</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Department</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="studentsTable">
                    {{-- Filled dynamically via API --}}
                </tbody>
            </table>

            <!-- Notification Form -->
        <div id="notificationForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-xl w-96">
                <h2 class="text-xl font-bold mb-4">Send Notification</h2>
                <textarea id="notificationMessage" class="border w-full p-2 rounded mb-4" placeholder="Type your message"></textarea>
                <div class="flex justify-end gap-2">
                    <button id="cancelNotificationBtn" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button id="sendBtn" class="px-4 py-2 bg-blue-600 text-white rounded">Send</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
const tableBody = document.getElementById('studentsTable');
const searchInput = document.getElementById('searchInput');
const totalStudentsSpan = document.getElementById('totalStudents');
const sendNotificationBtn = document.getElementById('sendNotificationBtn');

// --- Add hidden modal for notifications ---
const body = document.body;
const notificationForm = document.createElement('div');
notificationForm.id = 'notificationForm';
notificationForm.className = 'hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
notificationForm.innerHTML = `
    <div class="bg-white p-6 rounded-xl w-96">
        <h2 class="text-xl font-bold mb-4">Send Notification</h2>
        <textarea id="notificationMessage" class="border w-full p-2 rounded mb-4" placeholder="Type your message"></textarea>
        <div class="flex justify-end gap-2">
            <button id="cancelNotificationBtn" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
            <button id="sendBtn" class="px-4 py-2 bg-blue-600 text-white rounded">Send</button>
        </div>
    </div>
`;
body.appendChild(notificationForm);

// --- Use event delegation because buttons are dynamically added ---
notificationForm.addEventListener('click', (e) => {
    if (e.target.id === 'cancelNotificationBtn') {
        notificationForm.classList.add('hidden');
    }
    if (e.target.id === 'sendBtn') {
        const msg = document.getElementById('notificationMessage').value.trim();
        if (!msg) {
            alert('Please type a message!');
            return;
        }
        // Replace this with actual backend call
        alert('Notification sent: ' + msg);
        document.getElementById('notificationMessage').value = '';
        notificationForm.classList.add('hidden');
    }
});

// --- Fetch students ---
async function fetchStudents(search = '') {
    const res = await fetch(`/api/students?search=${search}`);
    const data = await res.json();

    tableBody.innerHTML = '';
    totalStudentsSpan.textContent = data.total || data.data.length;

    if (!data.data.length) {
        tableBody.innerHTML = `<tr><td colspan="5" class="p-4 text-center">No students found</td></tr>`;
        return;
    }

    data.data.forEach(user => {
        tableBody.innerHTML += `
            <tr class="border-b hover:bg-gray-100">
                <td class="p-3">${user.first_name} ${user.last_name}</td>
                <td class="p-3">${user.student_id}</td>
                <td class="p-3">${user.email}</td>
                <td class="p-3">${user.department ?? '-'}</td>
                <td class="p-3">
                    <a href="/admin/students/${user.id}" class="text-blue-600 underline mr-3">View</a>
                    <a href="/admin/students/${user.id}/edit" class="text-green-600 underline">Edit</a>
                </td>
            </tr>`;
    });
}

// --- Search functionality ---
searchInput.addEventListener('input', () => fetchStudents(searchInput.value));

// --- Show notification modal ---
sendNotificationBtn.addEventListener('click', () => {
    notificationForm.classList.remove('hidden');
});

// --- Initial load ---
fetchStudents();
</script>


</body>
</html>
