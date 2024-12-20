<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="w-full py-24 px-32">
        <div class="w-full flex justify-between">
            <div class="px-20">
                <div class="mb-10">
                    <a href="/" class="bg-red-500 py-3 px-5 text-white rounded-lg w-32 text-center text-xl font-bold block"><i class="bi bi-arrow-left"></i> Back</a>
                </div>
                <div class="header">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Image"
                        class="block rounded-lg overflow-hidden w-full max-h-96 object-cover">
                </div>

                <div class="main">
                    <h1 class="text-4xl text-white mt-10 font-extrabold">{{ $blog->title }}</h1>
                    <div class="flex items-center space-x-3 mt-5 mb-14">
                        <img src="{{ asset('storage/' . $blog->user->image) }}" alt="Image"
                            class="rounded-full w-8 h-8" />
                        <div>
                            <div class="flex items-center space-x-3">
                                <h1 class="font-semibold text-slate-400 text-sm">{{ $blog->user->username }}</h1>
                                <div class="bg-yellow-300 w-3 h-3 rounded-full animate-pulse" title="Admin"></div>

                            </div>
                            <p class="text-xs text-slate-400 font-normal">{{ $blog->created_at->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-5 text-slate-400 font-normal text-lg">
                        {!! $blog->content !!}
                    </div>
                </div>
                <div class="komentar mt-32">
                    <div class="flex items-center space-x-5">
                        <div class="bg-green-400 rounded-full w-7 h-7 animate-bounce"></div>
                        <h1 class="font-bold text-white text-4xl">Komentar</h1>
                    </div>
                    @if (!Auth()->user())
                        <div class="w-full rounded-lg bg-yellow-200 flex items-center justify-center py-5 px-5 mt-8">
                            <h1 class="font-bold text-black text-center text-xl">Anda Harus login terlebih dahulu <a
                                    href="{{ route('login') }}" class="text-blue-400 underline font-bold">disini</a>
                            </h1>
                        </div>
                    @else
                        <form action="{{ route('blogs.comment', $blog->id) }}" method="post">
                            @csrf
                            <div class="row mt-5">
                                <textarea name="comment" cols="10" rows="5" placeholder="Comment disini!!"
                                    class="w-full block mt-4 bg-slate-200 outline-none border py-2 px-3 rounded-lg text-black font-semibold"></textarea>
                            </div>
                            <button type="submit"
                                class="px-5 py-3 text-white rounded-lg cursor-pointer bg-indigo-500 hover:bg-indigo-600 shadow-md mt-5">Kirim
                                Komentar</button>
                        </form>
                        <div class="border-b mt-10"></div>
                    @endif
                    @if ($blog->comments->isEmpty())
                        <p class="text-gray-400 mt-5">Belum ada komentar.</p>
                    @else
                    @foreach ($blog->comments as $comment)
                    <div class="komentar w-full mt-8">
                        <div class="flex space-x-5">
                            <img src="{{ $comment->user->image ? asset('storage/' . $comment->user->image) : 'https://via.placeholder.com/40' }}"
                                alt="profile" class="rounded-full w-10 h-10">
                            <div>
                                <div class="flex items-center space-x-3">
                                    <h1 class="font-bold text-white text-sm">{{ $comment->user->username }}</h1>
                                    @if (auth()->check() && auth()->id() === $comment->user_id)
                                        <form action="{{ route('delete.comment', $comment->id) }}" method="POST"
                                              id="delete-form-{{ $comment->id }}" class="inline" data-id="{{ $comment->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 bg-transparent border-none p-0">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-400 font-normal">
                                    {{ $comment->created_at->format('d-m-Y | H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="block mt-3">
                            <h1 class="font-semibold text-white">{{ $comment->isi }}</h1>
                        </div>
                    </div>
                @endforeach

                    @endif
                </div>
            </div>
            <div class="w-full ml-10 px-10">
                @foreach ($recentBlogs as $item)
                    <div class="mx-auto mt-12">
                        <a href="{{ route('blogView', $item->slug) }}">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Image"
                                class="w-full block rounded-lg object-cover" />
                            <h1 class="font-extrabold mt-4 text-lg underline text-white">{{ $item->title }}</h1>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    <x-alerts.swicth-alerts-success />
    <script src="{{ asset('dist/js/scriptValdatedDelete.js') }}"></script>
</body>

</html>
