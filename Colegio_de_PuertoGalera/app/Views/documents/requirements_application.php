<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Requirements</title>
    <style>
        table { width: 100%; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h1>Application Requirements</h1>
    
    <form action="" method="post">
        <table border="1" cellpadding="10" cellspacing="0" id="requirementsTable">
            <tr>
                <th>Requirement</th>
                <th>Option</th>
            </tr>
            <tr>
                <td>Select Requirement</td>
                <td>
                    <select name="requirements[]">
                        <option value="Certificate of Registration">Certificate of Registration</option>
                        <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                        <option value="Certificate of Grades">Certificate of Grades</option>
                        <option value="Student ID">Student ID</option>
                    </select>
                </td>
            </tr>
        </table>
        <br>
        <button type="button" onclick="addRequirement()">Add Requirement</button>
        <button type="submit">Submit</button>
    </form>

    <script>
        function addRequirement() {
            // Get the table element
            const table = document.getElementById('requirementsTable');
            // Create a new row
            const newRow = document.createElement('tr');
            // Set the HTML for the new row
            newRow.innerHTML = `
                <td>Select Requirement</td>
                <td>
                    <select name="requirements[]">
                        <option value="Certificate of Registration">Certificate of Registration</option>
                        <option value="Certificate of Enrollment">Certificate of Enrollment</option>
                        <option value="Certificate of Grades">Certificate of Grades</option>
                        <option value="Student ID">Student ID</option>
                    </select>
                </td>
            `;
            // Append the new row to the table
            table.appendChild(newRow);
        }
    </script>
</body>
</html>
