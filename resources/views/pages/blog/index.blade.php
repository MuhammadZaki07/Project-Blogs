<x-app-layout>
    <div class="py-28">
        <div class="w-full px-5 lg:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mx-auto px-32">
                <div class="col-span-2">
                    <div class="mb-10">
                        <form action="{{ route('blogs.search') }}" method="get" class="flex flex-wrap justify-center gap-3">
                            <input type="text" name="search" placeholder="Search..."
                                class="w-full lg:w-1/2 rounded-lg bg-white py-3 px-5 text-black font-bold shadow-md"
                                value="{{ request('search') }}">
                            <button type="submit"
                                class="px-5 py-3 text-white rounded-lg cursor-pointer bg-indigo-500 hover:bg-indigo-600 shadow-md">
                                Search
                            </button>
                            <a href="/" class="px-5 py-3 text-white rounded-lg cursor-pointer bg-green-500 hover:bg-green-600 shadow-md">
                                <i class="bi bi-arrow-repeat"></i>
                            </a>
                        </form>
                    </div>

                    @if ($blogs->isEmpty())
                        <h1 class="text-center font-bold text-4xl text-gray-300">Tidak Ada Blogs Saat ini!!🥸</h1>
                    @else
                        @foreach ($blogs as $item)
                            <div class="blogs mt-8 border-gray-700 pb-5">
                                <div class="flex space-x-3 items-center">
                                    <img src="{{ $item->image ? asset('storage/' . $item->user->image) : asset('assets/profile.png') }}"
                                        alt="Image" class="rounded-lg object-cover w-10 h-10">
                                    <div>
                                        <a href="{{ route('blogs.byUser', $item->user->id) }}">
                                            <p class="font-semibold text-white text-sm">{{ $item->user->username }}</p>
                                        </a>
                                        <a href="{{ route('category.show', $item->category->id) }}">
                                            <p class="font-normal text-gray-400 text-xs">Kategori:
                                                {{ $item->category->name }}</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('blogView', $item->slug) }}"
                                        class="text-2xl font-bold hover:underline text-blue-400 hover:text-blue-600">
                                        {{  Str::limit(strip_tags($item->title), 70, '...') }}
                                    </a>
                                    <p class="font-normal text-lg text-slate-200 mt-2 w-3/4">
                                        {!! Str::limit(strip_tags($item->content), 200, '...') !!}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="ads">
                    <div class="mt-10">
                        @if ($recentBlogs->isEmpty())
                        <h1 class="text-center text-white font-bold text-4xl">Upss!!</h1>
                        @else
                        <h2 class="text-3xl font-bold text-gray-200 mb-4">Rekomendasi</h2>
                        @foreach ($recentBlogs as $item)
                            <a href="{{ route('blogView', $item->slug) }}" class="block mb-6">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Image"
                                    class="w-full max-h-72 object-cover rounded-lg mb-2 shadow-md">
                                <h1 class="font-bold hover:underline text-white text-lg mt-3">{{ $item->title }}</h1>
                            </a>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
