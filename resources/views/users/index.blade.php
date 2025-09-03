<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users</title>
<link rel="preconnect" href="https://www.google.com/search?q=https://fonts.googleapis.com">
<link rel="preconnect" href="https://www.google.com/search?q=https://fonts.gstatic.com" crossorigin>
<link href="https://www.google.com/search?q=https://fonts.googleapis.com/css2%3Ffamily%3DInter:wght%40400%3B600%26display%3Dswap" rel="stylesheet">
<style>
body {
font-family: 'Inter', sans-serif;
background-color: #f3f4f6;
color: #1f2937;
margin: 0;
padding: 2rem;
display: flex;
flex-direction: column;
align-items: center;
}
.container {
max-width: 800px;
width: 100%;
}
h1 {
text-align: center;
font-size: 2.5rem;
font-weight: 600;
margin-bottom: 2rem;
color: #111827;
}
table {
width: 100%;
border-collapse: collapse;
background-color: #ffffff;
border-radius: 12px;
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
overflow: hidden;
}
th, td {
padding: 1.5rem;
text-align: left;
border-bottom: 1px solid #e5e7eb;
font-size: 1.125rem;
line-height: 1.6;
}
th {
background-color: #f9fafb;
font-weight: 600;
color: #374151;
}
tr:last-child td {
border-bottom: none;
}
.action-link {
color: #4f46e5;
text-decoration: none;
font-weight: 600;
transition: color 0.2s ease-in-out;
}
.action-link:hover {
color: #4338ca;
}
</style>
</head>
<body>
<div class="container">
<h1>Users List</h1>
<table>
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@foreach ($users as $user)
<tr>
<td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>
<a href="{{ route('users.show', $user->id) }}" class="action-link">View</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</body>
</html>