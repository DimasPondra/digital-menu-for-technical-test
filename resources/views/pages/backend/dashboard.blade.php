<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Admin page

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf

        <button type="submit" class="p-0 btn btn-sm btn-link hover-off">Logout</button>
    </form>
</body>
</html>
