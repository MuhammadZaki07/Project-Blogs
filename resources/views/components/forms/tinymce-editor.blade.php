<div class="col-span-2">
    <label for="content" class="font-bold text-gray-800 text-lg">Content</label>
    @props(['value'])

    <textarea name="content" id="content" rows="5" placeholder="Write your content here..." class="w-full py-3 px-5 bg-gray-100 text-gray-800 font-semibold rounded-lg outline-none">{!! $value !!}</textarea>
</div>
