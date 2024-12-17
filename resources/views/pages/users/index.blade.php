<x-app-layout>
    @if ($users->isEmpty())
    <div class="px-52 py-44 w-full">
        <h1 class="text-white font-bold text-4xl text-center">Data users tidak ada!!</h1>
    </div>
    @else
        <div class="grid grid-cols-3 gap-10 py-32 px-44">
            @foreach ($users as $item)
                <div
                    class="relative flex flex-col items-center rounded-[20px] w-[400px] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                    <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover">
                        <img src='https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExbnhra2phY3VpeDNvZnUxa3BvdTJ6cGliYzNjZ2V5Ymh0YTZ3MDQ0aCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/kAZpkMzC9PPTXU8oP7/giphy.webp'
                            class="absolute flex h-32 w-full justify-center rounded-xl bg-cover">
                        <div
                            class="absolute -bottom-12 flex h-[87px] w-[87px] items-center justify-center rounded-full border-[4px] border-white bg-slate-900 dark:!border-navy-700">
                            <img class="h-full w-full rounded-full" src='{{ asset('storage/' . $item->image) }}'
                                alt="" />
                        </div>
                    </div>
                    <div class="mt-16 flex flex-col items-center">
                        <h4 class="text-xl font-bold text-black">
                            {{ $item->username }}
                        </h4>
                        <p class="text-base font-normal text-gray-600">{{ $item->role }}</p>
                    </div>
                    <div class="mt-6 mb-3 flex gap-14 md:!gap-14">
                        <div class="flex flex-col items-center justify-center">
                            <p class="text-2xl font-bold text-black">{{ $totalPosts }}</p>
                            <p class="text-sm font-normal text-gray-600">Posts</p>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <p class="text-2xl font-bold text-black">{{ $totalComments }}</p>
                            <p class="text-sm font-normal text-gray-600">Comments</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
