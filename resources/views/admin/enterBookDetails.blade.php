<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div>
                    <b>Enter book details</b>
                </div>
                <form style="width: 500px;" class="mx-auto my-5" id="storeBook" action="/store" method="post">
                    <input type="hidden" id="token" value="{{csrf_token()}}">
                        <label for="name" class="px-10 py-auto">Title:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="title" id="title" placeholder="Enter the title"> <br><br>

                        <label for="name" class="px-10 py-auto">ISBN:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="isbn" id="isbn" placeholder="Enter ISBN - digits only"> <br><br>

                        <label for="edition" class="px-10 py-auto">Edition:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="edition" id="edition" placeholder="Edition Number"> <br><br>

                        <label for="author" class="px-10 py-auto">Author:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="author" id="author" placeholder="Author Name"> <br><br>

                        <label for="Year" class="px-10 py-auto">Publishing Year:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="year" id="year" placeholder="Enter 4 digit year"> <br><br>

                        <label for="category" class="px-10 py-auto">Summary:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="summary" id="summary" placeholder="A short summary"> <br><br>

                        <label for="name" class="px-10 py-auto">Tags:</label>
                        <input class="rounded-lg float-right py-auto" type="text" name="tags" id="tags" placeholder="Comma separated values!"> <br><br>

                        <button type="submit" name="save" value="save" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-4 py-2 my-5 mx-5 ">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/bookCrud.js') }}"></script>
</x-app-layout>
