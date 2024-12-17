<x-app-layout>
    <div class="w-full mx-auto py-36 px-44">
        <div class="px-96">
            <form action="{{ route('category.search') }}" method="get" class="mb-10">
                <input type="text" name="category" id="search-input" placeholder="Search category..."
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-500"
                    value="{{ request('category') }}">
                <button type="submit"
                    class="mt-4 w-full p-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Search
                </button>
            </form>

        </div>

        <!-- Category Cards -->
        <div class="py-20 px-32">
            @if ($categories->isEmpty())
            <h1 class="text-center font-bold text-4xl text-white">Data Tidak Ada!!</h1>
            @else
            <div class="grid grid-cols-3 gap-10">
                @foreach ($categories as $item)
                <a href="{{ route('category.show' , $item->id) }}">
                    <div class="card bg-gradient-to-r cursor-pointer w-full h-64 flex justify-center items-center rounded-lg p-4 relative overflow-hidden">
                        <div class="absolute inset-0">
                            <img id="{{ $item->name }}-bg" src="" alt="" class="object-cover w-full h-full">
                            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                        </div>
                        <h1 class="font-bold text-4xl text-center text-white relative z-10">{{ $item->name }}</h1>
                    </div>
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function fetchImage(category, elementId) {
            fetch(`https://api.unsplash.com/search/photos?query=${category}&client_id=lN2xq3PnCze1bdnyNHZQ3fOS5U5rcSq7GKeFRgKvx84`)
                .then(response => response.json())
                .then(data => {
                    const imgElement = document.getElementById(elementId);
                    imgElement.src = data.results[0].urls.full;
                })
                .catch(error => console.error('Error fetching images:', error));
        }

        function searchCategory() {
            const category = document.getElementById('search-input').value;
            if (category) {
                fetchImage(category, `${category}-bg`);
            } else {
                console.error('Please enter a category.');
            }
        }

        // Sesuaikan dengan nama kategori yang ada di database Anda
        @foreach ($categories as $item)
        fetchImage('{{ $item->name }}', '{{ $item->name }}-bg');
        @endforeach
    </script>
</x-app-layout>
