<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <b>Enter book detials</b>
                </div>
                <form style="margin: 0 auto; width: 400px;" id="storeBook" action="/store" method="post">
                    <input type="hidden" id="token" value="{{csrf_token()}}">
                        <label for="name" class="px-10">Name:</label>
                        <input class="rounded-lg float-right" type="text" name="name" id="name"> <br><br>

                        <label for="edition" class="px-10">Edition:</label>
                        <input class="rounded-lg float-right" type="text" name="edition" id="edition"> <br><br>

                        <label for="author" class="px-10">Author:</label>
                        <input class="rounded-lg float-right" type="text" name="author" id="author"> <br><br>

                        <label for="Year" class="px-10">Year:</label>
                        <input class="rounded-lg float-right" type="text" name="year" id="year"> <br><br>

                        <label for="category" class="px-10">Category:</label>
                        <input class="rounded-lg float-right" type="text" name="category" id="category"> <br><br>

                        <button type="submit" name="save" value="save" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-4 py-2 float-right mb-5">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/bookCrud.js') }}"></script>
</x-app-layout>
