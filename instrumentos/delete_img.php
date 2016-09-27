
<?php
/*if(!empty($foto_inst["foto_inst"])){
    $largura=150;
    $altura=180;
    $tamanho=1000;
}
if(!preg_match("/^image/(pjpeg|jpeg|png|gif|bmp)$/", $foto_inst["foto_inst"])){
    $error[1]= "isso não é uma imagem";
    $dimensoes=  getimagesize($foto_inst["tpm_name"]);
    if($dimensoes[0]> $largura){
        $error[2]="a largura da imagem não deve ultrapassar".$largura. "pixels";
    }
    if($dimensoes[0]> $altura){
        $error[3]="a altura da imagem não deve ultrapassar".$altura. "pixels";  
    }
        if($foto_inst("size")> $tamanho){
        $error[4]="a imagem deve ter no máximo".$tamanho. "bytes";
        }
        if(count($error)==0){
            preg_match("/.(pjpeg|jpeg|png|gif|bmp)$/i", $foto_inst["fotoinst"], $ext);
        }
    $nomeimg= md5(uniquit(time())). "." .$ext[1];
    $caminho="foto_inst/" . $nomeimg;
    move_uploaded_file($foto_inst["tpm_name"], $caminho);
	
}*/
?>