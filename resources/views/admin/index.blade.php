<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('add book')
                        <form id="addBook" action="/book-details" method="get" class="mb-5">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-5 py-2">
                                {{ __('Add a book') }}
                            </button>
                        </form>
                    @endcan
                    <table style="width: 100%;" class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Sr. No.</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Name</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Edition</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Author</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Year</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Category</th>
                                @canAny(['update book', 'delete book'])    
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200">Operations</th>
                                @endcanAny
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$book->id}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$book->name}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$book->edition}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$book->author}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$book->year}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200">{{$book->category}}</td>                                    
                            @can('update book')
                            <td class="text-start px-5 py-3 border border-slate-200">
                                <button class="bg-blue-500 rounded-md px-2.5 py-1 text-sm text-white hover:bg-blue-700" type="submit" onclick="$(this).editBook('{{$book->id}}', '{{csrf_token()}}', '{{$book->name}}', '{{$book->edition}}', '{{$book->author}}', '{{$book->year}}', '{{$book->category}}')" name="edit" value="edit">Edit</button>
                            @endcan
                            @can('delete book')
                                <button class="bg-red-500 rounded-md px-1 py-1 text-sm text-white hover:bg-red-700" type="submit" onclick="$(this).deleteBook('{{$book->id}}', '{{csrf_token()}}')" name="delete" value="delete">Delete</button>
                                </td>
                            @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/bookCrud.js') }}"></script>
</x-app-layout>