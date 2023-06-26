<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="addBook" action="/book-details" method="get" class="mb-5">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-5 py-2">
                            {{ __('Add a book') }}
                        </button>
                    </form>
                    <table style="width: 100%;" class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Sr. No.</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Title</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">ISBN</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Summary</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Edition</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Author</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Publishing Year</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Genre</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Categories</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Tags</th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$book->id}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$book->title}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$book->isbn}}</td>
                                <td class="text-start py-3 border border-slate-200 text-sm">{{$book->summary}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$book->edition->number}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$book->author->name}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$book->publish_date}}</td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                    {{$book->categories->first()->genre->name}}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                    @foreach ($book->categories as $category)
                                        {{$category->name}}
                                        @if(!$category == $loop->last)
                                        ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                    @foreach ($book->tags as $tag)
                                        {{$tag->name}}
                                        @if(!$tag == $loop->last)
                                        ,
                                        @endif
                                    @endforeach
                                </td>
                            @if(auth()->user()->hasRole('admin') || auth()->user()->id == $book->user_id)
                            <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                <a class="bg-blue-500 rounded-md px-2.5 py-1 my-1 text-sm text-white hover:bg-blue-700" href="/edit-book/{{$book->id}}">Edit</a>
                            
                            
                                <button class="bg-red-500 rounded-md px-1 py-1 my-1 text-sm text-white hover:bg-red-700" type="submit" onclick="$(this).deleteBook('{{$book->id}}', '{{csrf_token()}}')" name="delete" value="delete">Delete</button>
                                </td>
                            @endif
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