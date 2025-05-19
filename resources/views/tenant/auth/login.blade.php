<!DOCTYPE html>
<html>
<head>
    <title>Tenant Login</title>
</head>
<body>
    <h2>Tenant Login</h2>

    @if($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('tenant.login.submit') }}">
        @csrf
        <label for="phone">Phone:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label for="id_number">ID Number:</label><br>
        <input type="text" name="id_number" value="{{ old('id_number') }}"><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
