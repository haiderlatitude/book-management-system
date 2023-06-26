$(document).ready(function(){

    allCategoryDivIds = $('.categoryDiv').map(function(){ return $(this).attr('id'); });
    allCategoryDivs = $('.categoryDiv');
    genreValue = $('#genre').val();
    for(i = 0; i < allCategoryDivIds.length; i++){
        if(allCategoryDivIds[i] == genreValue){
            allCategoryDivs.filter('#'+genreValue).show();
        }
    }

    $.fn.toggleAuthor = function(){
        if($('#authorSelection').hasClass('hidden')){
            $('#authorSelection').removeClass('hidden');
        }
        else{
            $('#authorSelection').addClass('hidden');
        }

        if($('#author').hasClass('hidden')){
            $('#author').removeClass('hidden');
        }
        else{
            $('#author').addClass('hidden');
        }
    }

    $.fn.toggleEdition = function(){
        if($('#editionSelection').hasClass('hidden')){
            $('#editionSelection').removeClass('hidden');
        }
        else{
            $('#editionSelection').addClass('hidden');
        }

        if($('#edition').hasClass('hidden')){
            $('#edition').removeClass('hidden');
        }
        else{
            $('#edition').addClass('hidden');
        }
    }

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
        
        let userId, title, edition, isbn, genre, categories, token, author, publishingYear, summary, tags;
        
        userId = $('#userId').val();
        title = $('#title').val();
        isbn = $('#isbn').val();
        edition = $('#edition').val() == '' ? $('#editionSelection').val() : $('#edition').val();
        author = $('#author').val() == '' ? $('#authorSelection').val() : $('#author').val();
        publishingYear = $('#year').val();
        token = $('#token').val();
        summary = $('#summary').val();
        genre = $('#genre').val();
        categories = $('.categories:checked').map(function(){
            return $(this).attr('id');
        }).get();
        tags = $('.tags:checked').map(function(){
            return $(this).attr('id');
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
                    userid: userId,
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

    $('form#editBook').submit(function(e){
        e.preventDefault();

        Swal.fire({
            title: "Are you sure you want to update the book details?",
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#ef4444',
            confirmButtonColor: '#3b82f6',
            allowOutsideClick: false,
            preConfirm: (input) => {
                let id, updatedTitle, updatedEdition, updatedIsbn, updatedGenre, updatedCategories, token, updatedAuthor, updatedPublishingYear, updatedSummary, updatedTags;
                
                id = $('#bookId').val();
                updatedTitle = $('#title').val();
                updatedIsbn = $('#isbn').val();
                updatedEdition = $('#edition').val() == '' ? $('#editionSelection').val() : $('#edition').val();
                updatedAuthor = $('#author').val() == '' ? $('#authorSelection').val() : $('#author').val();
                updatedPublishingYear = $('#year').val();
                token = $('#token').val();
                updatedSummary = $('#summary').val();
                updatedGenre = $('#genre').val();
                updatedCategories = $('.categories:checked').map(function(){
                    return $(this).attr('id');
                }).get();
                updatedTags = $('.tags:checked').map(function(){
                    return $(this).attr('id');
                }).get();

                if(!(isNaN(updatedPublishingYear) && isNaN(updatedEdition) && isNaN(updatedIsbn))){
                    $.ajax({
                        url: '/update/'+id,
                        method: 'put',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        data: {
                            title: updatedTitle,
                            isbn: updatedIsbn,
                            author: updatedAuthor,
                            publishingYear: updatedPublishingYear,
                            edition: updatedEdition,
                            genre: updatedGenre,
                            categories: updatedCategories,
                            summary: updatedSummary,
                            tags: updatedTags,

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

                        error: function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'Some error occured!',
                                confirmButtonColor: '#3b82f6',
                                preConfirm: (input) =>{
                                    window.location.href = '/admin';
                                }
                            });
                        }
                    });
                }
                else{
                    Swal.showValidationMessage('Year, Edition and ISBN fields must be a Number!');
                }
            }
        });    
    });

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
});