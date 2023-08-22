<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ config('app.name') }}</title>
</head>

<body>
    <div
        class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12 bg-gradient-to-r from-cyan-500 to-blue-500">
        <div
            class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-md">
                <div class="divide-y divide-gray-300/50">
                    <div class="space-y-6 py-8 text-base leading-7 text-gray-600">
                        <p>
                            {{ config('app.name') }}
                        </p>
                        <p>
                            An advanced online playground for Tailwind CSS, including support for things like:
                        </p>
                        <p>
                            Perfect for learning how the framework works, prototyping a new idea, or creating a demo
                            to
                            share online.
                        </p>
                        <a href="{{ route('login') }}">login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
