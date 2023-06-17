$(document).ready(function(){

    $("form#storeBook").submit(function(e){
        e.preventDefault();
        
        let name, edition, author, year, category, token;
        name = $('#name').val();
        edition = $('#edition').val();
        author = $('#author').val();
        year = $('#year').val();
        category = $('#category').val();
        token = $('#token').val();
        
        if(name == "" || year == "" || author == "" || edition == "" || category == ""){
            Swal.fire({
                icon: 'error',
                title: 'All fields are required!',
                confirmButtonColor: '#3b82f6',
            });
        }

        else if(!(isNaN(year) && isNaN(edition))){
            $.ajax({
                url: '/store',
                method: 'post',
                headers:{
                    'X-CSRF-TOKEN': token,
                },
                data: {
                    name: name,
                    edition: edition,
                    author: author,
                    year: year,
                    category: category,
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
                        icon: response.type,
                        title: response.message,
                        confirmButtonColor: '#3b82f6',
                    });
                }
            });
        }

        else{
            Swal.fire({
                icon: 'error',
                title: 'Year and Edition fields must be a Number!',
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
                    title: response,
                    confirmButtonColor: '#3b82f6',
                })
            }
        });
    }
})