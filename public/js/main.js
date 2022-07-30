

$(document).ready(function() {
    
    jQuery('#more-products').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var page_number = document.getElementById('page_number').value;

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
    
    // Paiement (CinetPay)
    jQuery('#paiement-form').submit( (e) => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(e.target).entries());
        console.log(data);

        CinetPay.setConfig({
            apikey: '112927115762d1e45cb26ef2.15035831', // YOUR APIKEY
            site_id: 'http://oumarmaiga.com', // YOUR_SITE_ID
            notify_url: 'http://oumarmaiga.com/notify/',
            mode: 'PRODUCTION',
            return_url: 'http://localhost:8000/commande/1/paiement'
        });
        CinetPay.getCheckout({
            transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
            amount: data.montant,
            currency: 'XOF',
            channels: 'ALL',
            description: 'Paiement sur djassa',   
                
            //Fournir ces variables pour le paiements par carte bancaire
            customer_name: data.customer_name,
            customer_surname: data.customer_surname,
            customer_email:  data.customer_email,
            customer_phone_number:  data.customer_phone_number,
            customer_address :  data.customer_address,
            customer_city:  data.customer_city,
            customer_country :  data.customer_country,
            customer_state :  data.customer_state,
            customer_zip_code :  data.customer_zip_code,
        });
        CinetPay.waitResponse(function(data) {
            console.log("REFUSED");
            if (data.status == "REFUSED") {
                if (alert("Votre paiement a échoué")) {
                    window.location.reload();
                }
            } else if (data.status == "ACCEPTED") {
                console.log("ACCEPTED");
                if (alert("Votre paiement a été effectué avec succès")) {
                    window.location.reload();
                }
            }
        });
        CinetPay.onError(function(data) {
            console.log(data);
        });

        /*var axios = require('axios');
        var data = JSON.stringify({
            "apikey": '112927115762d1e45cb26ef2.15035831', // YOUR APIKEY
            "site_id": 'http://oumarmaiga.com', // YOUR_SITE_ID
            "notify_url": 'http://oumarmaiga.com/notify/',
            "mode": 'PRODUCTION',
            "return_url": 'http://localhost:8000/commande/1/paiement',
            "transaction_id":  Math.floor(Math.random() * 100000000).toString(), //
            "amount": form_data.montant,
            "currency": 'XOF',
            "channels": 'ALL',
            "description": 'Paiement sur djassa',   
                
            //Fournir ces variables pour le paiements par carte bancaire
            "customer_name": form_data.customer_name, 
            "customer_surname": form_data.customer_surname,
            "customer_email": form_data.customer_email, 
            "customer_phone_number": form_data.customer_phone_number,
            "customer_address" :form_data.customer_address, 
            "customer_city": form_data.customer_city,
            "customer_country" :form_data.customer_country, 
            "customer_state" :form_data.customer_state,
            "customer_zip_code" :form_data.customer_zip_code,
            "alternative_currency": "",
            "customer_id": "172",
            "metadata": "user1",
            "lang": "FR",
            "invoice_data": {
                "Donnee1": "",
                "Donnee2": "",
                "Donnee3": ""
            }
        });
    
        var config = {
            method: 'post',
            url: 'https://api-checkout.cinetpay.com/v2/payment',
            headers: { 
            'Content-Type': 'application/json'
            },
            data : data
        };
    
        axios(config)
        .then(function (response) {
            console.log(JSON.stringify(response.data));
        })
        .catch(function (error) {
            console.log(error);
        });*/
    
    });

    // Recherche
    jQuery('#search-form').submit( (e) => {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(e.target).entries());
        $.get('/search', {query: data.query}, function(markup) {
            $('#main').html(markup);
        }); 
    });
});
