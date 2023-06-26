<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <b>Enter new details</b>
                    </div>
                    <form style="width: 550px;" class="mx-auto my-5" id="editBook" method="post">
                        <input type="hidden" id="token" value="{{csrf_token()}}">
                        <input type="hidden" id="bookId" value="{{$book->id}}">
                            <label for="title" class="px-10">Title:</label>
                            <input style="width:308px;" class="rounded-lg float-right py-auto" type="text" name="title" id="title" value="{{$book->title}}"> <br><br>
    
                            <label for="isbn" class="px-10 py-auto">ISBN:</label>
                            <input style="width:308px;" class="rounded-lg float-right py-auto" type="text" name="isbn" id="isbn" value="{{$book->isbn}}"> <br><br>
    
                            <label for="edition" class="px-10 py-auto">Edition:</label>
                            <button style="height: 42px; display: inline;" onclick="event.preventDefault(); $(this).toggleEdition();" class="bg-blue-500 rounded-md px-2 ml-1 text-white float-right">Add Edition</button> 
                            <input style="width:204px;" class="hidden rounded-lg float-right py-auto" type="text" name="edition" id="edition" placeholder="Edition Number">
                            <select style="width:204px;" class="rounded-lg float-right py-auto" name="editionSelection" id="editionSelection">
                                <option value="chooseEdition">-- Choose Edition --</option>
                                @foreach ($editions as $edition)
                                    @if($edition->number == $book->edition->number)
                                        <option value="{{$book->edition->number}}" selected>{{$book->edition->number}}</option>
                                    @else
                                        <option value="{{$edition->number}}">{{$edition->number}}</option>
                                    @endif
                                @endforeach
                            </select><br><br>
    
                            <label for="author" class="px-10 py-auto">Author:</label>
                            <button style="height: 42px; display: inline;" onclick="event.preventDefault(); $(this).toggleAuthor();" class="bg-blue-500 rounded-md px-2 ml-1 text-white float-right">Add Author</button> 
                            <input style="width:204px;" class="hidden rounded-lg float-right py-auto" type="text" name="author" id="author" placeholder="Author Name">
                            <select style="width:204px;" class="rounded-lg float-right py-auto" name="authorSelection" id="authorSelection">
                                <option value="chooseAuthor">-- Choose Author --</option>
                                @foreach ($authors as $author)
                                    @if($book->author->name == $author->name)
                                        <option value="{{$book->author->name}}" selected>{{$book->author->name}}</option>
                                    @else
                                        <option value="{{$author->name}}">{{$author->name}}</option>
                                    @endif
                                @endforeach
                            </select><br><br>
    
                            <label for="genre" class="px-10">Genre:</label>
                            <select name="genre" id="genre" class="rounded-lg float-right" style="width:308px;">
                                <option value="choose-genre" selected>-- Choose Genre --</option>
                                @foreach ($genres as $genre)
                                    @if($genre->id == $book->categories->first()->genre->id)
                                        <option value="{{$book->categories->first()->genre->id}}" selected>{{$book->categories->first()->genre->name}}</option>
                                    @else
                                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                                    @endif
                                @endforeach
                            </select> <br><br>
    
                            @foreach ($genres as $genre)
                                <div class="hidden categoryDiv mx-8 my-5" id="{{$genre->id}}">
                                    <label for="categories">Select Categories:</label> <br>
                                    @foreach ($genre->categories as $category)
                                        <div style="display: inline;" class="mx-3">
                                            <input type="checkbox" @if ($book->categories->contains($category->id))
                                                checked
                                            @endif class="categories mx-3 my-3" name="{{$category->name}}" id="{{$category->id}}" value="{{$category->name}}">
                                            <label for="{{$category->name}}">{{$category->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
    
                            <label for="year" class="px-10 py-auto">Publishing Year:</label>
                            <input style="width:308px;" class="rounded-lg float-right py-auto" type="text" name="year" id="year" value="{{$book->publish_date}}"> <br><br>
    
                            <label for="summary" class="px-10 py-auto">Summary:</label>
                            <input style="width:308px;" class="rounded-lg float-right py-auto" type="text" name="summary" id="summary" value="{{$book->summary}}"> <br><br>
    
                            <label for="tags" class="px-10 py-auto">Select Tags:</label>
                            <div class="mx-8 my-5">
                                @foreach ($tags as $tag)
                                    <div style="display: inline;" class="mx-3">
                                        <input type="checkbox" @if ($book->tags->contains($tag->id))
                                            checked
                                        @endif name="{{$tag->name}}" id="{{$tag->id}}" class="tags mx-3 my-3" value="{{$tag->name}}">
                                        <label for="{{$tag->name}}">{{$tag->name}}</label>
                                    </div>
                                @endforeach
                            </div>
    
                            <button type="submit" name="save" value="save" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg px-5 py-2 my-5 mx-10 ">Update</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/bookCrud.js')}}"></script>
</x-app-layout>
