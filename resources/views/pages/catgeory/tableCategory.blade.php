<x-app-layout>
    <div class="container mx-auto py-24">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div class="w-full">
                <h1 class="text-[3rem] font-bold text-gray-800 dark:text-gray-200">Data Category</h1>
                <p class="text-gray-600 dark:text-gray-400 w-7/12 mt-3">Kelola kategori dengan mudah di sini.</p>
            </div>
            <button data-modal-target="create-modal" data-modal-toggle="create-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Create
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse w-full">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-200">Name</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-600 dark:text-gray-200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->isEmpty())
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-gray-800 text-lg text-center font-bold">Data tidak ada</td>
                    </tr>
                    @else
                    @foreach ($categories as $item)
                        <tr class="border-b bg-gray-50">
                            <td class="px-6 py-4 text-gray-800 font-normal text-lg">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-gray-800 font-normal text-lg">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-4">
                                    <button data-modal-target="edit-modal-{{ $item->id }}" data-modal-toggle="edit-modal-{{ $item->id }}"
                                        onclick="fillEditForm({{ $item->id }})"
                                        class="text-white hover:text-yellow-700 bg-yellow-300 rounded-lg py-3 px-4">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('delete.category', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}">
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

    <x-modal-components modalId="create-modal" title="Create New Category">
        <form action="{{ route('create.category') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg font-bold mb-3 text-white">Name</label>
                <input type="text" name="name" id="name"
                    class="block w-full p-2 border rounded-lg bg-gray-50 font-normal text-gray-900"
                    placeholder="Enter category name">
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Add Category
            </button>
        </form>
    </x-modal-components>

    @foreach ($categories as $item)
        <x-modal-components modalId="edit-modal-{{ $item->id }}" title="Edit Category">
            <form action="{{ route('update.category', $item->id) }}" method="POST" id="edit-form-{{ $item->id }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
                    <label for="edit-name" class="block text-lg font-bold mb-3 text-white">Name</label>
                    <input type="text" name="name" id="edit-name"
                        class="block w-full p-2 border rounded-lg bg-gray-50 font-normal text-gray-900" value="{{ $item->name }}">
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Update Category
                </button>
            </form>
        </x-modal-components>
    @endforeach
</x-app-layout>
