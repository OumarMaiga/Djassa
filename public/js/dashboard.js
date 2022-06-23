    jQuery(document).ready(function(){
        jQuery('#rayon_id').change(function(e){
            e.preventDefault();
            var id = document.getElementById('rayon_id').value;
            if (id == "") {
                var category_id_container = $('#category_id_container');
                category_id_container.hide();
                var category_id = $('#category_id');
                category_id.empty();
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/dashboard/rayon/" +id + "/categories",
                method: 'get',
                success: function(result){
                    var data = result['categories'];
                    var category_id = $('#category_id');
                    category_id.empty();
                    category_id.append(
                        '<option value="">-- SELECTIONNEZ ICI --</option>'
                    )
                    for (var i = 0; i < data.length; i++) {
                        category_id.append(
                            '<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>'
                        );
                    }
                    var category_id_container = $('#category_id_container');
                    category_id_container.show();
               }
            });
        });
        
        jQuery('#category_id').change(function(e){
            e.preventDefault();
            var id = document.getElementById('category_id').value;
            if (id == "") {
                var sub_category_id_container = $('#sub_category_id_container');
                sub_category_id_container.hide();
                var sub_category_id = $('#sub_category_id');
                sub_category_id.empty();
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/dashboard/category/" +id + "/sub_categories",
                method: 'get',
                success: function(result){
                    var data = result['sub_categories'];
                    var sub_category_id = $('#sub_category_id');
                    sub_category_id.empty();
                    sub_category_id.append(
                        '<option value="">-- SELECTIONNEZ ICI --</option>'
                    )
                    for (var i = 0; i < data.length; i++) {
                        sub_category_id.append(
                            '<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>'
                        );
                    }
                    var sub_category_id_container = $('#sub_category_id_container');
                    sub_category_id_container.show();
               }
            });
        });
        
        jQuery('#sub_category_id').change(function(e){
            e.preventDefault();
            var id = document.getElementById('sub_category_id').value;
            if (id == "") {
                var sub_sub_category_id_container = $('#sub_sub_category_id_container');
                sub_sub_category_id_container.hide();
                var sub_sub_category_id = $('#sub_sub_category_id');
                sub_sub_category_id.empty();
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/dashboard/sub_category/" +id + "/sub_sub_categories",
                method: 'get',
                success: function(result){
                    var data = result['sub_sub_categories'];
                    var sub_sub_category_id = $('#sub_sub_category_id');
                    sub_sub_category_id.empty();
                    sub_sub_category_id.append(
                        '<option value="">-- SELECTIONNEZ ICI --</option>'
                    )
                    for (var i = 0; i < data.length; i++) {
                        sub_sub_category_id.append(
                            '<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].title + '</option>'
                        );
                    }
                    var sub_sub_category_id_container = $('#sub_sub_category_id_container');
                    sub_sub_category_id_container.show();
               }
            });
        });
    });
