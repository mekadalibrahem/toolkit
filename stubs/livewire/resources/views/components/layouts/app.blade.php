<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $title ?? 'page' }}-{{ Config::get('app.name') }}
    </title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body >
    <div class="antialiased  bg-gray-50 dark:text-white  dark:bg-gray-700">
        <main >
            {{
                $slot
            }}
        </main>
    </div>



</body>
</html>
