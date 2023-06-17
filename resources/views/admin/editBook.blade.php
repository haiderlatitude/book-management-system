<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md text-red-700 dark:text-gray-200">
            @if(count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            => {{$error}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <b>Enter new book details</b>
                </div>
                    <form style="margin: 0 auto; width: 400px;" onsubmit="if(confirm('Are you sure you want to update the specified book?')) return true; else return false;" action="/update/{{ $book->id }}" method="post">
                        @csrf @method('put')

                        <label for="name" class="px-10">Name:</label>
                        <input class="rounded-lg float-right" type="text" name="name" id="name" value="{{ $book->name }}"> <br><br>

                        <label for="edition" class="px-10">Edition:</label>
                        <input class="rounded-lg float-right" type="text" name="edition" id="edition" value="{{ $book->edition }}"> <br><br>

                        <label for="author" class="px-10">Author:</label>
                        <input class="rounded-lg float-right" type="text" name="author" id="author" value="{{ $book->author }}"> <br><br>

                        <label for="Year" class="px-10">Year:</label>
                        <input class="rounded-lg float-right" type="text" name="year" id="year" value="{{ $book->year }}"> <br><br>

                        <label for="category" class="px-10">Category:</label>
                        <input class="rounded-lg float-right" type="text" name="category" id="category" value="{{ $book->category }}"> <br><br>

                        <button type="submit" name="update" value="update" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-2 py-2 float-right mb-5">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
