<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Students</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Students</h1>

        <input
            type="text"
            id="searchInput"
            placeholder="Search by name, email, or student ID"
            class="border px-3 py-2 rounded w-72 mb-4"
        />

        <div class="bg-white shadow rounded">
            <table class="w-full border-collapse" id="studentsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="border p-2 text-left">Name</th>
                        <th class="border p-2 text-left">Student ID</th>
                        <th class="border p-2 text-left">Email</th>
                        <th class="border p-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- JS will fill this -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const tableBody = document.querySelector('#studentsTable tbody');
        const searchInput = document.getElementById('searchInput');

        // Function to fetch students from API
        async function fetchStudents(search = '') {
            const response = await fetch(`/api/students?search=${search}`);
            const data = await response.json();

            // Clear table
            tableBody.innerHTML = '';

            if (data.data.length === 0) {
                tableBody.innerHTML = `<tr><td class="border p-2 text-center" colspan="4">No students found</td></tr>`;
                return;
            }

            data.data.forEach(student => {
                const row = document.createElement('tr');
                row.classList.add('odd:bg-gray-50');

                row.innerHTML = `
                    <td class="border p-2">${student.name}</td>
                    <td class="border p-2">${student.student_id}</td>
                    <td class="border p-2">${student.email}</td>
                    <td class="border p-2">
                        <span class="${student.status === 'active' ? 'text-green-600' : 'text-red-600'}">
                            ${student.status.charAt(0).toUpperCase() + student.status.slice(1)}
                        </span>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        }

        // Initial load
        fetchStudents();

        // Search functionality
        searchInput.addEventListener('input', () => {
            fetchStudents(searchInput.value);
        });
    </script>
</body>
</html>
