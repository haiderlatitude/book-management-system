$(document).ready(function(){

    $('#genre').change(function(){
        if($('#genre').val() == "choose-genre"){
            $('.categoryDiv').hide();
        }

        else{
            $('.categories').prop('checked', false);
            let genre = $('#genre').val();
            let genreId = "#"+genre;
            $('.categoryDiv').hide();
            $(genreId).show();
        }
    });

    $("form#storeBook").submit(function(e){
        e.preventDefault();
        
        let title, edition, isbn, genre, categories, token, author, publishingYear, summary, tags;
        
        title = $('#title').val();
        isbn = $('#isbn').val();
        edition = $('#edition').val();
        author = $('#author').val();
        publishingYear = $('#year').val();
        token = $('#token').val();
        summary = $('#summary').val();
        genre = $('#genre').val();
        categories = $('.categories:checked').map(function(){
            return $(this).val();
        }).get();
        tags = $('.tags:checked').map(function(){
            return $(this).val();
        }).get();
        
        
        if(title == "" || publishingYear == "" || author == "" || edition == "" || genre == "" || tags == "" || isbn == "" || tags == "" || summary == ""){
            Swal.fire({
                icon: 'error',
                title: 'All fields are required!',
                confirmButtonColor: '#3b82f6',
            });
        }

        else if(!(isNaN(publishingYear) && isNaN(edition) && isNaN(isbn))){
            $.ajax({
                url: '/store',
                method: 'post',
                headers:{
                    'X-CSRF-TOKEN': token,
                },
                data: {
                    title: title,
                    edition: edition,
                    author: author,
                    publishingYear: publishingYear,
                    isbn: isbn,
                    tags: tags,
                    genre: genre,
                    categories: categories,
                    summary: summary,
                },
    
                success: function(response){
                    Swal.fire({
                        icon: response.type,
                        title: response.message,
                        confirmButtonColor: '#3b82f6',
                        
                        preConfirm: () => {
                            if(response.message == "Book has been saved successfully!"){
                                window.location.href = '/admin';
                            }
                        }
                    });
    
                },
    
                error: function(response){
                    Swal.fire({
                        icon: 'error',
                        title: 'Some error occured!',
                        confirmButtonColor: '#3b82f6',
                    });
                }
            });
        }

        else{
            Swal.fire({
                icon: 'error',
                title: 'Year, Edition and ISBN fields must be a Number!',
                confirmButtonColor: '#3b82f6',
            });
        }

    });

    $.fn.editBook = function(id, token, oldName, oldEdition, oldAuthor, oldYear, oldCategory){
        let name, author, edition, year, category;
        Swal.fire({
            title: "Enter the details:",
            html: '<label for="name" class="float-left">Name:</label><input class="rounded-lg float-right" style="width:70%;" type="text" name="name" id="name" value="'+oldName+'"> <br><br><label for="edition" class="float-left">Edition:</label><input class="rounded-lg float-right" style="width:70%;" type="text" name="edition" id="edition" value="'+oldEdition+'"> <br><br><label for="author" class="float-left">Author:</label><input class="rounded-lg float-right" style="width:70%;" type="text" name="author" id="author" value="'+oldAuthor+'"> <br><br><label for="Year" class="float-left">Year:</label><input class="rounded-lg float-right" style="width:70%;" type="text" name="year" id="year" value="'+oldYear+'"> <br><br><label for="category" class="float-left">Category:</label><input class="rounded-lg float-right" style="width:70%;" type="text" name="category" id="category" value="'+oldCategory+'">',
            showCancelButton: true,
            cancelButtonColor: '#ef4444',
            confirmButtonColor: '#3b82f6',
            allowOutsideClick: false,
            preConfirm: (input) => {
                name = $('#name').val();
                year = $('#year').val();
                author = $('#author').val();
                edition = $('#edition').val();
                category = $('#category').val();

                if(!isNaN(year) && !isNaN(edition)){
                    $.ajax({
                        url: '/update/'+id,
                        method: 'put',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data: {
                            name: name,
                            author: author,
                            year: year,
                            edition:edition,
                            category: category
                        },
            
                        success: function(response){
                            Swal.fire({
                                icon: response.type,
                                title: response.message,
                                confirmButtonColor: '#3b82f6',
                                preConfirm: (input) =>{
                                    window.location.href = '/admin';
                                }
                            });
                        },
                    });
                }
                else{
                    Swal.showValidationMessage('Year and Edition fields must be a Number!');
                }
            }
        });

        
    }

    $.fn.deleteBook = function(id, token) {
        Swal.fire({
            title: 'Are you sure, you really want to delete this book?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#ef4444',
            preConfirm: () => {
                $.ajax({
                    url: '/delete/' + id,
                    method: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': token,
                    },
        
                    success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: response,
                            confirmButtonColor: '#3b82f6',
        
                            preConfirm: (input) => {
                                window.location.href = '/admin';
                            }
                        });
                    },
        
                    error: function(response){
                        Swal.fire({
                            icon: 'error',
                            title: 'Some error occured, please try again later!',
                            confirmButtonColor: '#3b82f6',
                        })
                    }
                });
            }
        });
    }
})