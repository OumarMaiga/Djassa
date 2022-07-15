

$(document).ready(function() {
    
    jQuery('#more-products').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var page_number = document.getElementById('page_number').value;
        //var page_number = 1;
        jQuery.ajax({
            url: "/products/more-products/" +page_number ,
            method: 'get',
            success: function(result) {
                var products = result['products'];
                var products_container = $('#products-container');
                for (var i = 0; i < products.length; i++) {

                    image = products[i].files_file_path;

                    products_container.append (
                        '<div class="col-2 mt-4">'+
                            '<div class="card shadow-sm">'+
                                '<a href="/product/'+products[i].product_id+'" class="py-2 mt-2 mx-3" style="background:#F6F6F6;text-align:center;border-radius:4px;font-weight:700; margin-bottom:25%; cursor:pointer">Voir les offres</a>'+
                                '<img src="'+image+'" class="img-responsive mx-3" style="margin-bottom:10%;height:75px;object-fit:cover;" alt="...">'+
                                '<div class="card-body">'+
                                    '<p class="px-2" style="background:#ec6333;color:#fff;font-weight:800; font-size:14px; width:40%">-'+products[i].product_discount+'%</p>'+
                                    '<p class="item-offre-title" style="font-size:13px; font-weight:600">'+products[i].product_title+'</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
                // On increment le page_number
                document.getElementById('page_number').value = parseInt(page_number) + 1;
            }
        });
    });
});
