<link rel="stylesheet"  type="text/css" href="<?php echo ARCTPDiarios; ?>css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="<?php echo ARCTPDiarios; ?>js/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet"  type="text/css" href="<?php echo ARCTPDiarios; ?>js/DataTables-1.10.20/css/dataTables.bootstrap4.css">
    <style type="text/css">
      table tr {
        text-align: center;
      }
    </style>
    <?php
        global $wpdb;
        $listTPTapa  = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "TPTapa");
     ?>
    <br>
    <br>
    <div class="container">
<nav class="navbar navbar-default">
	<img src="<?php echo ARCTPDiarios; ?>images/logo.png" width="72" height="72" style="float:left; margin:7px">
    <h2>Tapas de Diarios</h2>
	<p>Complete la configuración necesaria a continuación para que el Widget de Tapas de diarios funcione correctamente.</p>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     <button type="button" class="btn btn-success navbar-btn" id="resgitartpdiarios">Agregar Imagen</button> 
    </div>
  </div>
</nav>
<div class="row">
      <div class="col-lg-12">
        <div id="msgtpdiarios"></div>
       <div class="table-responsive">
        <table id="datatablecontrolsliderpage" class="table table-striped table-bordered"  style="width:100%">
         <thead id='registetpdiarios'>
          <tr>
           <th scope="col">Titulo</th>
           <th scope="col">Url Img</th>
           <th scope="col">Url Slug</th>
           <th scope="col">Imagen</th>
           <th scope="col">Editar</th>
           <th scope="col">Eliminar</th>
         </tr>
       </thead>
       <tbody id="listbusqueda">
        <?php
        foreach ($listTPTapa as $TPTapap) {
         ?>
         <tr id="listTPTapa">
          <td><?php echo $TPTapap->title; ?></td>
          <td><?php echo $TPTapap->enlaceimg; ?></td>
          <td><?php echo $TPTapap->url; ?></td>
          <td style="padding: 0;"><img  src="<?php echo $TPTapap->enlaceimg;?>" height="70" width="80"></td>
          <td>
            <span class="glyphicon glyphicon-edit btn text-primary" onclick="editar(<?php echo $TPTapap->id_TPTapa; ?>)">
            </span>
          </td>
          <td><span data-namesp='<?php echo $TPTapap->title; ?>' class='text-danger btn deletsptpt glyphicon glyphicon-trash' data-idsp='<?php echo $TPTapap->id_TPTapa; ?>' id='deletsp<?php echo $TPTapap->id_TPTapa; ?>' title='Eliminar' data-toggle='modal' data-target='#Modaldeletsp'></span>
            <span data-toggle='modal' data-target='#Modaldeletsp'></span></td>
        </tr>
      <?php }?>
    </tbody>
  </table>
</div>
</div>

<div class="modal fade" id="Modaldeletsp" role="dialog">
  <div class="modal-dialog modal-md">
   <div class="modal-content">
    <div class="modal-header">

     <h4 class="modal-title" id="titlemsjdeletsp"></h4>
   </div>
   <div class="modal-body text-center" id="imp1">
     <p id="mensajedeletsp"></p>
   </div>
   <div class="modal-footer">
     <button type="button" class="close mr-5" data-dismiss="modal">x</button>
     <div id="btnmodaldeletsp"></div>
   </div>
 </div>
</div>
</div>
<div class="modal fade" id="vereditpdiarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Editar Widget</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formtpdiariosed">
      <div class="modal-body">
        <div class="form-horizontal">
          <div id="msgtpdiariosedi"></div>
          <div class="form-group">
            <label for="fpsetfrom" class="col-md-5 control-label">Titulo del Diario</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="titleed" name="title" placeholder="Titulo del Diario" required autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="fpsetfrom" class="col-md-5 control-label">Url Img</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="enlaceed" name="enlace" placeholder="Enlace de la imagen" required autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="fpsetfrom" class="col-md-5 control-label">Url Slug</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="urled" name="url" placeholder="Url Slug" required autocomplete="off">
            </div>
          </div>
          <div class="form-groupcol-md-12 text-center">
            <img src='' height='120' width='115' id="imgedi">
          </div>
          <input type="hidden" name="ideditar" id="ideditar">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="tpdiariosedi" class="btn btn-success">Guardar</button>
        <img style="display: none;" src="<?php echo ARCTPDiarios; ?>/images/carga.gif" id="tpdiarioscarga" width="100px" height="60px">
      </div>
    </div>
    </form>
  </div>
</div>
	<p><?= __('Este plugin fue desarrollado por', 'TPTapa'); ?> <a href="https://www.evolucionstreaming.com" target="_blank" title="<?= __('Evolucion Streaming - Servicios Informáticos', 'TPTapa'); ?>"><?= __('Evolucion Streaming - Servicios Informáticos', 'TPTapa'); ?></a>.</p>
<script type="text/javascript" src="<?php echo ARCTPDiarios; ?>/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo ARCTPDiarios; ?>/js/maindatatable.js"></script>
<script type="text/javascript">
  let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
  let idsave = 0;
  document.getElementById('resgitartpdiarios').addEventListener(touchEvent,()=>{
    var trregsli = document.createElement("tr");
    trregsli.insertAdjacentHTML("afterbegin", `
            <td><input type='text' name='title' id='title`+idsave+`' placeholder='Titulo'></td>
            <td><input type='text' name='enlace' id='enlace`+idsave+`' placeholder='Enlace'></td>
            <td><input type='text' name='url' id='url`+idsave+`' placeholder='Url'></td>
            <td style='padding: 0;'><img src='<?php echo ARCTPDiarios; ?>/images/2154830.svg' height='70' width='80' alt='img'></td>
            <td COLSPAN="2">
              <button class="btn btn-success" onclick="guardartpdiarios('formsave`+idsave+`',title`+idsave+`,enlace`+idsave+`,url`+idsave+`)"><span class="glyphicon glyphicon-save text-default">
              </span> Guardar</button>
            </td></tr>`);
    document.getElementById("registetpdiarios").appendChild(trregsli);
    trregsli.setAttribute('id', 'formsave'+idsave);
    idsave++;
  });
  function editar(id){

    titled = document.getElementById("titleed");
    enlaced = document.getElementById("enlaceed");
    urld = document.getElementById("urled");
    jQuery.ajax({
      url: sqltpdiarios.sqlajaxpage,
      type: 'post',
      data: {
        idtptdiario: id,
        acti: 'verEditpdiarios',
        action: 'sqltpdiarios'
      },
      success: function(dato) {
        var data = JSON.parse(dato);
        console.log(dato);
        var idsli = data['id'];
        document.getElementById("ideditar").value = idsli;
        titled.value = data['title'];
        enlaced.value = data['enlace'];
        urld.value = data['url'];
        document.getElementById("imgedi").setAttribute('src',data['enlace']);
        jQuery('#vereditpdiarios').modal("show");
      }
    });
  }

  function guardartpdiarios(formid,titles,enlaces,urls){

    var ti = titles.value, en = enlaces.value ,ur = urls.value;
    var data = {title:ti,enlace:en,url:ur,acti:'saveTPTapa',action:'sqltpdiarios'};
     jQuery.ajax({
            url: sqltpdiarios.sqlajaxpage,
            type: "post",
            data: data,
            success: function(dato) {
              console.log(dato);
              var dat = JSON.parse(dato);
              console.log(dat);
              if (dat['res']==true) {
                document.getElementById('msgtpdiarios').innerHTML = dat['msg'];
                document.getElementById(formid).innerHTML = `<td>`+dat['title']+`</td>
            <td>`+dat['enlace']+`</td>
            <td>`+dat['url']+`</td>
            <td style='padding: 0;'><img src='`+dat['enlace']+`' height='70' width='80'></td>
            <td>
            <span class='glyphicon glyphicon-edit btn text-primary' onclick='editar(`+dat['id']+`)'>
            </span>
          </td>
          <td><span data-namesp='`+dat['title']+`' class='text-danger btn deletsp glyphicon glyphicon-trash' data-idsp='`+dat['id']+`' id='deletsp`+dat['id']+`' title='Eliminar' data-toggle='modal' data-target='#Modaldeletsp'></span>
            <span data-toggle='modal' data-target='#Modaldeletsp'></span></td>`;
              }else{
                document.getElementById('msgtpdiarios').innerHTML = dat['msg'];
              }
            }
        });
    }

</script>