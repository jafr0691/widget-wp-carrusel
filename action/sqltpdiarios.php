<?php
global $wpdb;
if ($_POST['acti']=='saveTPTapa') {
	$errors = array();
	if(!empty($_POST))
	{
		$title = $_POST['title'];
		$enlace = $_POST['enlace'];
        $url = str_replace(" ", "-", $_POST['url']);
		if(isNull($title,$enlace,$url))
		{
			$errors[] = "Debe llenar todos los campos";
		}
        if(Existe('title',$title))
        {
            $errors[] = "Titulo ya exite";
        }
        if(Existe('enlaceimg',$enlace))
        {
            $errors[] = "Enlace de imagen ya exite";
        }

		if(Existe('url',$url))
		{
			$errors[] = "Nombre de la Url ya exite";
		}
		if(count($errors) == 0)
		{
			$registro =  registraTPTapa($title,$enlace,$url);
			if($registro['res'])
			{
				exit(json_encode($registro));
				} else {
				$errors[] = "Error al Registrar Slider";
			}
		}
	}

    $data = array('res' => false, 'msg'=>resultBlock($errors,'danger'));
	exit(json_encode($data));
}else if ($_POST['acti']=='savetpdiarios') {
$errors = array();
    if(!empty($_POST))
    {
        $title = $_POST['title'];
        $enlace = $_POST['enlace'];
        $url = str_replace(" ", "-", $_POST['url']);
        $id = $_POST['ideditar'];
        if(isNull($title,$enlace,$url,$id))
        {
            $errors[] = "Debe llenar todos los campos";
        }

        if(Existe('title',$title,$id))
        {
            $errors[] = "Titulo ya exite";
        }
        if(Existe('enlaceimg',$enlace,$id))
        {
            $errors[] = "Enlace de imagen ya exite";
        }

        if(Existe('url',$url,$id))
        {
            $errors[] = "Nombre de la Url ya exite";
        }
        if(count($errors) == 0)
        {
            $updatsli =updateTPTapa($title,$enlace,$url,$id);
            // if($updatsli['res'])
            // {
                exit(json_encode($updatsli));
            // } else {
            //     $errors[] = "Error al Editar Slider";
            // }
        }
    }

    $data = array('res' => false, 'msg'=>resultBlock($errors,'danger'));
    exit(json_encode($data));
}else if ($_POST['acti']=='delettpt') {
    $wpdb->delete($wpdb->prefix . 'TPTapa', array('id_TPTapa' => $_POST['id']));
}else if($_POST['acti']=='verEditpdiarios'){
$id = $_POST['idtptdiario'];
$vsli = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "TPTapa WHERE id_TPTapa=".$id);

$dato = array('id'=>$vsli->id_TPTapa,
    'title' => $vsli->title,
    'enlace'=>$vsli->enlaceimg,
    'url'=>$vsli->url);

exit(json_encode($dato));

}