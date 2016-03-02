/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$( document ).ready(function() {
    $('#image-panel').hide();
    
    /*
     * Called when the user clicks to close the annotation area
     */
    $('#close-annotation-area').click(function() {
        $('#image-panel').hide();
    });
    
    $('.with-term').click(function() {
        $('#image-panel').show();
        
        var element = $(this).attr('id');
        var images_html = '';
        
        $.ajax({            
            type: 'POST',
            url: '/retrieve_images/' + element,
            dataType: 'json',
            success: function(data) {                
                for(var i = 0; i < data.images.length; i++) {
                    var img = new Image();
                    
                    img.onload = function() {
                        images_html += "<a href='javascript:insert_image(\"" + 
                                element + "\",\"" + this.src + "\")'>";                    
                        images_html += "<img src='" + this.src + "'>";
                        images_html += "</a>";    
                        $('#images').html(images_html);
                    }
                    img.src = data.images[i];
                }                
            },
        });
    });
});

function insert_image(where, image) {
    $('#img' + where).html("<img src='" + image + "'>");
}

