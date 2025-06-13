<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body class="bg-gray-100 gap-4">

<div class="w-1/3 mx-auto mt-40 relative items-center rounded-lg">

    <img
        src=""
        class="bg-gray-600 rounded-full w-32 h-32 object-cover absolute -top-16 left-1/2
        transform -translate-x-1/2 border-4 border-white shadow-lg"
    />

    <div class="bg-gray-400 p-10 pt-24 rounded-lg flex flex-col gap-6">

        <div class=" flex  flex-col gap-8 mt-10">

            <input type="text"
                   placeholder="Email"
                   class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center "/>
            <input type="password"
                   placeholder="Password"
                   class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center"/>

        </div>
        <button type="submit"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-800 w-2/3 items-center mx-auto">Login
        </button>
    </div>

</div>
</div>

</body>
</html>
