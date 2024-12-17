<x-app-layout>
    <div class="container mx-auto py-24">
        <div class="flex justify-between items-center mb-8">
            <div class="w-full">
                <h1 class="text-[3rem] font-bold text-gray-800 dark:text-gray-200">Data Blogs</h1>
                <p class="text-gray-600 dark:text-gray-400 w-7/12">Halaman ini menmapilkan data-data blogs , dan terdapat fungsi create,read,update,delete</p>
            </div>
            <a href="{{ route('create.blog') }}"
                class="bg-blue-500 text-white px-7 py-3 rounded shadow hover:bg-blue-600 focus:outline-none">Create</a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse w-full">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Image</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Author</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Date Created</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-600 dark:text-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($blogs->isEmpty())
                        <tr class="border-bbg-gray-50 bg-gray-200">
                            <td class="px-6 py-4 text-gray-800 text-center font-bold text-lg" colspan="7">Data tidak ada</td>
                        </tr>
                    @else
                    @foreach ($blogs as $item)
                    <tr class="border-bbg-gray-50 bg-gray-200 odd:bg-white even:bg-slate-50">
                        <td class="px-6 py-4 text-gray-800 font-bold text-lg">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-gray-800 font-normal text-sm">{{ $item->title }}</td>
                        <td class="px-6 py-4 text-gray-800 text-lg">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="h-20 rounded-lg w-28 object-cover">
                        </td>
                        <td class="px-6 py-4 text-gray-800 font-normal text-sm">{{ $item->user->name }}</td>
                        <td class="px-6 py-4 text-gray-800 font-normal text-sm">{{ $item->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-4">
                                <a href="{{ route('blogView',$item->slug) }}" class="text-blue-500 hover:text-blue-700 bg-blue-300 rounded-lg py-3 px-4" title="Show">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('edit.blog', $item->id) }}" class="text-white hover:text-yellow-700 bg-yellow-300 rounded-lg py-3 px-4" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('delete.blog', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 bg-red-300 rounded-lg py-3 px-4">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
