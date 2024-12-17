<x-app-layout>
    <div class="px-32 w-full flex justify-center py-36 ">
        <div class="container">
            <div class="haed mb-5">
                <h1 class="font-bold text-white text-[3rem]">Edit Blogs</h1>
                <p class="text-sm text-slate-300 font-normal mt-3">Halaman ini untuk mengedit blog</p>
            </div>
            <div class="bg-white w-full rounded-lg shadow-lg py-5 px-8">
                <div class="overflow-hidden rounded-lg w-full mb-8">
                    <img id="imagePrev"
                         src="{{ $blogs->image ? asset('storage/' . $blogs->image) : 'https://asset.gecdesigns.com/img/wallpapers/beautiful-magical-misty-mountains-reflection-river-ultra-hd-wallpaper-4k-sr10012420-1706505766369-cover.webp' }}"
                         alt="image preview"
                         class="w-full max-h-96 object-cover rounded-lg">
                </div>
                <form action="{{ route('update.blog', $blogs->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Title Input -->
                        <div class="row">
                            <label for="title" class="font-bold text-gray-800 text-lg">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title"
                                value="{{ old('title', $blogs->title) }}"
                                class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                            @error('title')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Slug Input -->
                        <div class="row">
                            <label for="slug" class="font-bold text-gray-800 text-lg">Slug</label>
                            <input type="text" name="slug" id="slug" placeholder="Slug"
                                value="{{ old('slug', $blogs->slug) }}"
                                class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                            @error('slug')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category Dropdown -->
                        <div class="row">
                            <label for="category_id" class="font-bold text-gray-800 text-lg">Category</label>
                            <select name="category_id" id="category_id"
                                class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                                @if ($categories->isEmpty())
                                    <option value="" @readonly(true)>No Data</option>
                                @else
                                    <option value="#" disabled>Pilih Category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $blogs->category_id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Input -->
                        <div class="row">
                            <label for="image" class="font-bold text-gray-800 text-lg">Image</label>
                            <input type="file" name="image" id="image"
                                class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                            @if ($errors->has('image'))
                                <span class="text-red-600">{{ $errors->first('image') }}</span>
                            @endif
                        </div>

                        <!-- Content Editor -->
                        <x-forms.tinymce-editor :value="old('content', $blogs->content)" />
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit"
                            class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">Update Post</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
