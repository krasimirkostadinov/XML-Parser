$(document).ready(function () {
    //submit search
    $('#search-btn').on('click', function (e) {
        e.preventDefault();
        var searched_text = $('#search-text').val();
        if (searched_text.trim().length > 0) {
            $.ajax({
                url: host_path + '/ajax/search.php',
                type: 'post',
                dataType: 'json',
                data: {searched_text: searched_text}
            }).success(function (result) {
                $('.search-result-container').css('display', 'block');
                $('.searched-keyword').text(searched_text);
                $('#search-result').html(result);
                $('html, body').animate({
                    scrollTop: $('#search-res').offset().top
                }, 2000);

                //empty the search field
                $('#search-text').val('');
            }).fail(function () {
                $('body').append('<div class="alert alert-danger">Somethings wrong. Please try again!</div>');
            });
        }
        else {
            alert('Plese insert atleast 1 symbol for search');
        }
    });

    //add info from XML files to database
    $('#add-xml-data').on('click', function (e) {
        e.preventDefault;
        var agree = confirm("Do you really want to add these files in Database?");
        if(agree === false){
            return false;
        }
        var loader = '<img class="loader-image" src="' + host_path + '/public/images/loader.gif" />';
        $.ajax({
            url: host_path + '/ajax/insert-db.php',
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $('.xml-content').append(loader);
            }
        }).success(function (result) {
            $('.loader-image').remove();
            $('.full-xml-paths').before('<div class="alert alert-success">Successfully added XML data in Database</div>');
            window.setTimeout(function(){location.reload()},4000);
        }).fail(function () {
            $('.full-xml-paths').before('<div class="alert alert-danger">Somethings wrong. Please try again!</div>');
        });
    });
});