<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> login page</title>
</head>
<body>

    <div>

        <h1> login page </h1>
        <div>
            <form action="{{Route('login_handler')}}" method="GET" >
            @csrf

            <div>
                <label for="username">
                    username
                </label>
                <input type="text" name="username" id="username">
            </div>
            <br>
            <div>
                <label for="passwrd">password</label>
                <input type="passwprd" name="password"  id="passwprd">
            </div>
            <button type="submit">
                login
            </button>
            </form>
        </div>
    </div>

</body>
</html>
