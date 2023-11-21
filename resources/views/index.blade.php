@php
    use App\Models\Article;
    use App\Models\Image;
    $articles = Article::active()
        ->limit(7)
        ->get();
    $images = Image::active()
        ->limit(11)
        ->get();
@endphp
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('/image/laravel.svg') }}" type="image/x-icon">
</head>

<body class="bg-slate-50">
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="{{ asset('/image/laravel.svg') }}" alt="">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Beranda</a>
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Berita</a>
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Galeri</a>
                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">File</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="{{ route('login') }}"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    login
                </a>
            </div>
        </nav>
    </header>

    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-sky-500 to-teal-300 opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    {{ config('app.name') }}
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Content Management System with Filament
                </p>
                <div class="hidden sm:mb-8 sm:flex sm:justify-center py-5">
                    <div
                        class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Pelajari selengkapnya tentang
                        <a href="https://filamentphp.com/" class="font-semibold text-indigo-600">
                            {{-- <span class="absolute inset-0" aria-hidden="true">
                                </span> --}}
                            Filament
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Login
                        <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section id="berita" class="bg-slate-100 px-4 py-20">
        <div
            class="grid grid-cols-none sm:grid-cols-none md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 gap-4">
            <div class="bg-gradient-to-r from-sky-500 to-blue-500 rounded-xl shadow-md relative overflow-hidden">
                <div class="w-full h-64 object-cover rounded-xl bg-gradient-to-r from-sky-500 to-blue-500"></div>
                <div
                    class="absolute flex flex-col justify-center items-center inset-0  hover:duration-500 hover:opacity-80 bg-white hover:scale-150 ease-in-out duration-300">
                    <h6 class="font-bold text-xl mb-4">
                        Berita
                    </h6>
                    <p class="text-slate-700">
                        <a href="">
                            Lihat selengkapnya →
                        </a>
                    </p>
                </div>
            </div>
            @forelse ($articles as $article)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="row-span-1 rounded-xl overflow-hidden">
                        <img src="{{ asset('/storage/' . $article->file ?? '/image/default-img.svg') }}" alt="Gambar"
                            class="w-full h-64 object-cover rounded-xl transition-transform duration-300 ease-in-out hover:scale-110 overflow-hidden delay-300">
                    </div>
                    <div class="p-4">
                        <h6 class="font-bold mb-4 text-ellipsis overflow-hidden ...">
                            {{-- {{ $article->title ?? null }} --}}
                            {{ Str::limit(strip_tags($article->title ?? null), 200, '...') }}
                        </h6>
                        {{-- <p class="text-slate-700">
                            {{ $article->c ?? null }}
                            {{ Str::limit(strip_tags($article->content ?? null), 200, '...') }}
                        </p> --}}
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </section>

    <section id="galeri" class="bg-gradient-to-r from-sky-500 to-blue-500 px-4 py-20">
        <div
            class="grid grid-cols-none sm:grid-cols-none md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow-md relative overflow-hidden">
                <div class="w-full h-64 object-cover rounded-xl bg-white"></div>
                <div
                    class="absolute flex flex-col justify-center items-center inset-0  hover:duration-500 hover:opacity-80 bg-white hover:scale-150 ease-in-out duration-500">
                    <h6 class="font-bold text-xl mb-4">
                        Galeri
                    </h6>
                    <p class="text-slate-700">
                        <a href="">
                            Lihat selengkapnya →
                        </a>
                    </p>
                </div>
            </div>
            @foreach ($images as $image)
                <div class="bg-white rounded-xl shadow-md relative overflow-hidden">
                    <img src="{{ asset('/storage/' . $image->file) }}" alt="{{ $image->file }}"
                        class="w-full h-64 object-cover rounded-xl">
                    <a href="galeri/{{ $image->id }}"
                        class="absolute flex flex-col justify-center items-center inset-0 opacity-0 hover:duration-500 hover:opacity-80 bg-white p-4 ease-in-out duration-500">
                        <h6 class="font-bold mb-4">
                            {{ $image->title ?? null }}
                        </h6>
                        <p class="text-slate-700">
                            {{ $image->description ?? null }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

</body>

</html>
