<script>
    $('.also').select2({
        allowClear : true,
        multiple : true,
        placeholder : 'Select other product to recommend'
    });
   

    var alsoEdit = $('#also-edit')
    
    $.ajax({
        url: '/admin-php/dashboard.php',
        dataType: 'json',
        method: 'POST',
        data: {
            id: $('[name="prodid"]').val(),
            name: $('[name="title"]').val(),
            category: $('[name="category"]').val(),
            action: 'also-like'
        },
    })
    .then(function(data){
        var items = []
        data.items.forEach(function(item){
            if ($('#also-edit').find("option[value='" + item.id + "']").length) {
                // $('#also-edit').val(item.id).trigger('change');
            } else { 
                var option = new Option(item.text, item.id);
                items.push(option)
            } 
        })
        alsoEdit.append(items).trigger('change');
    })

</script>