(function($) {

    let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
    for (var i = 0; i <= document.querySelectorAll(".deletsptpt").length; i++) {
        document.querySelectorAll(".deletsptpt")[i].addEventListener(touchEvent, msjdeletsptpt);
    }

    function msjdeletsptpt(e) {
        console.log(e);
        var nombre = e.target.getAttribute('data-namesp');
        var id = e.target.getAttribute('data-idsp');
        document.getElementById('titlemsjdeletsp').innerHTML = '<strong>' + nombre + '</strong>';
        document.getElementById('mensajedeletsp').innerHTML = 'Desea eliminar Contacto <strong>' + nombre + '</strong>?';
        document.getElementById('btnmodaldeletsp').innerHTML = '<button class="btn btn-default rounded" style="position: absolute; left:30px; bottom: 10px;" id="btndeletsp" data-dismiss="modal" data-idsp="' + id + '">Eliminar <span class="text-danger glyphicon glyphicon-trash"></span></button>';
        document.getElementById('btndeletsp').addEventListener(touchEvent, deletsptpt);
    }

    function deletsptpt() {
        var id = document.getElementById('btndeletsp').getAttribute('data-idsp');
        jQuery.ajax({
            url: sqltpdiarios.sqlajaxpage,
            type: "post",
            data: {
                action: 'sqltpdiarios',
                acti: 'delettpt',
                id: id
            },
            success: function(d) {
                if (d) {
                    document.getElementById('deletsp' + id).parentElement.parentElement.remove();
                }
            }
        });
    }
        jQuery('#slideredi').on(touchEvent, function(e) {
        var data = jQuery("#formslidered").serialize();
        console.log(data);
        var dat = jQuery("#formslidered").serializeArray();
        var camvac = 0;
        jQuery.each(dat, function(i, val) {
            if (val.value == "") {
                alert("Ningun campo puede estar vacio");
                camvac = 1;
            }
        });
        if (camvac == 0) {
            jQuery.ajax({
                url: sqltpdiarios.sqlajaxpage,
                type: 'post',
                data: data + '&acti=savetpdiarios&action=sqltpdiarios',
                success: function(dato) {
                    var d = JSON.parse(dato);
                    console.log(d);
                    if (d['res']==true) {
                        document.getElementById("msgslideredi").innerHTML=d['msg'];
                        document.getElementById("formslidered").reset();
                        location.reload();
                    } else {
                        document.getElementById("msgslideredi").innerHTML=d['msg'];
                    }
                }
            });
        }
        e.preventDefault();
    });
})(jQuery);