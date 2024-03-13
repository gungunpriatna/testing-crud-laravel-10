<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Post - Tutorial CRUD Laravel 10 @ qadrlabs.com</title>
</head>

<body>

<div class="container mx-auto mt-10 mb-10 px-10">
    <div class="grid grid-cols-8 gap-4 p-5">
        <div class="col-span-4 mt-2">
            <h1 class="text-3xl font-bold">
                EDIT POST
            </h1>
        </div>
        <div class="col-span-4">

        </div>
    </div>
    <div class="bg-white p-5 rounded shadow-sm">
        <form action="{{ route('post.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="title">Title</label>
                <input type="text" class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded-full
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                  " name="title" value="{{ old('title', $post->title) }}" required>

                <!-- error message untuk title -->
                @error('title')
                <div class="bg-red-400 p-2 shadow-sm rounded mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="status">Publish Status</label>
                <select name="status" class="form-select appearance-none
                      block
                      w-full
                      px-3
                      py-1.5
                      text-base
                      font-normal
                      text-gray-700
                      bg-white bg-clip-padding bg-no-repeat
                      border border-solid border-gray-300
                      rounded-full
                      transition
                      ease-in-out
                      m-0 focus:text-gray-700 focus:bg-white
                      focus:border-blue-600 focus:outline-none" required>
                    <option value="1" {{ old('status', $post->status) == 1 ? 'selected':'' }} >Publish</option>
                    <option value="0" {{ old('status', $post->status) == 0 ? 'selected':'' }} >Draft</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="content">Content</label>
                <textarea
                    name="content" id="content"
                    class="
                        form-control
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                      "
                    cols="30" rows="10"
                    required>{{ old('content', $post->content) }}</textarea>

                <!-- error message untuk content -->
                @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mt-3">
                <button type="submit"
                        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Update
                </button>
                <a href="{{ route('post.index') }}"
                   class="inline-block px-6 py-2.5 bg-gray-200 text-gray-700 font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-300 hover:shadow-lg focus:bg-gray-300 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-400 active:shadow-lg transition duration-150 ease-in-out">back</a>
            </div>

        </form>

    </div>

</div>

<script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
</script>
</body>

</html>
