    $(document).ready(function() {
    const site_url = "https://pomazplaza.hu/";

    $("body").on("keyup", "#search", function() {
        let text = $(this).val();
        //console.log(text);

        if (text.length > 0) {
            $.ajax({

                data: { search: text },
                url: site_url + "search-product",
                method: 'post',
                data: {
               _token: '{{ csrf_token() }}'
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(result) {
                    $("#searchProducts").html(result);
                }
            }); //End Ajax
        }   

        if (text.length < 1) {
            $("#searchProducts").html("");
        }
    });
});