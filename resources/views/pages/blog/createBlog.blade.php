<x-app-layout>
    <div class="px-32 w-full flex justify-center py-36 ">
        <div class="container">
            <div class="header mb-5">
                <h1 class="font-bold text-white text-[3rem]">Create Blogs</h1>
                <p class="text-sm text-slate-300 font-normal mt-3">Halaman ini untuk membuat blog, dimana data akan di tampilkan ke user untuk di baca</p>
            </div>
            <div class="bg-white w-full rounded-lg shadow-lg py-5 px-8">
                <form action="{{ route('proccess.create.blog') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div class="row">
                            <label for="title" class="font-bold text-gray-800 text-lg">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" value="{{ old('title') }}" class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                            @error('title')<span class="text-red-600">{{ $message }}</span>@enderror
                        </div>

                        <div class="row">
                            <label for="slug" class="font-bold text-gray-800 text-lg">Slug</label>
                            <input type="text" name="slug" id="slug" placeholder="Slug" readonly value="{{ old('slug') }}" class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                        </div>

                        <div class="row">
                            <label for="category_id" class="font-bold text-gray-800 text-lg">Category</label>
                            <select name="category_id" id="category_id" class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                                @if ($categories->isEmpty())
                                <option value="" @readonly(true)>No Data</option>
                                @else
                                <option value="#" disabled selected>Pilih Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('category_id')<span class="text-red-600">{{ $message }}</span>@enderror
                        </div>


                        <div class="row">
                            <label for="image" class="font-bold text-gray-800 text-lg">Image</label>
                            <input type="file" name="image" id="image" class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">
                            @error('image')<span class="text-red-600">{{ $message }}</span>@enderror
                        </div>

                        <x-forms.tinymce-editor value="{{ old('content') }}"/>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
