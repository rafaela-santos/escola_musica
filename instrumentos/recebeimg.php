<?php
	include('../inc/conexao.php');
?>

</html>
<head>
   <title>upload de imagens</title>
</head>
<body>
   <form action="#" method="POST" enctype="multipart/form-data">
      <input type="file" name="fileUpload">
      <input type="submit" value="Enviar">
   </form>
</body>
</html>
 
<?php
  /* if(isset($_FILES['fileUpload']))
   {
      date_default_timezone_set("Brazil/East"); 
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); 
      $new_name = date("Y.m.d-H.i.s") . $ext; 
      $dir = 'imagens/'; 
 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); 
   }*/
 /*if(isset($_FILES['foto_inst']))
   {
      date_default_timezone_set("Brazil/East"); 
      $tiposPermitidos= array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
      $ext = strtolower(substr($_FILES['foto_inst']['name'],-4)); 
      $new_name = date("Y.m.d-H.i.s") . $ext; 
      $arqname=$_FILES['foto_inst']['tmp_name'];
      $arqType = $_FILES['arquivo']['type'];
      $arqError=$_FILES['arquivo']['error'];
      
      if ($arqError == 0) {
            if (array_search($arqname, $tiposPermitidos) === false) {
                echo 'O tipo de arquivo enviado é inválido!';
        
        } else {
                $dir = 'fotos/'; 
                $extensao = strtolower(end(explode('.', $arqname)));
                $nome = time() . '.' . $extensao;
                $nomeMySQL = mysql_real_escape_string($_POST['foto_inst']);
                move_uploaded_file($arqname, $dir.$new_name); 
   }
      }
   }*/

$consulta = mysqli_query("SELECT * FROM instrumentos WHERE (titulo = '$titulo' OR conteudo = '$conteudo')");
$resultado = mysqli_num_rows($consulta);
if ($resultado != 0){
	echo "<font face=verdana color=red size=8><center>material já cadastrado</center>
		<meta http-equiv=refresh content=5;url=index_inst.php>";

}
else{

		$uploadfile = $_FILES['figura']['tmp_name'];
		$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/figuras_cursos/' . $_FILES['figura']['name']."";
		$arquivo2 = $_FILES['figura']['name'];
		$link_figura = "fotos/".$_FILES['figura']['name']."";


$erro = $config = array();

$figura = isset($_FILES["figura"]) ? $_FILES["figura"] : FALSE;

$config["tamanho"] = 409600;

$config["largura"] = 512;

$config["altura"]  = 512;

if($figura)
{  

	if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $figura["type"]))
	{
		$erro[] = "Arquivo em formato inválido! A imagem deve ser jpg, jpeg, 
			bmp, gif ou png. Envie outro arquivo";
	}
	else
	{

		if($figura["size"] > $config["tamanho"])
		{
			$erro[] = "Arquivo em tamanho muito grande! 
		A imagem deve ser de no máximo " . $config["tamanho"] . " bytes. 
		Envie outro arquivo";
		}
		

		$tamanhos = getimagesize($figura["tmp_name"]);
		

		if($tamanhos[0] > $config["largura"])
		{
			$erro[] = "Largura da imagem não deve 
				ultrapassar " . $config["largura"] . " pixels";
		}


		if($tamanhos[1] > $config["altura"])
		{
			$erro[] = "Altura da imagem não deve 
				ultrapassar " . $config["altura"] . " pixels";
		}
	}
	

	if(sizeof($erro))
	{
		foreach($erro as $err)
		{
			echo " - " . $err . "<BR>";
		}

		echo "<a href=\"foto.html\">Fazer Upload de Outra Imagem</a>";
	}

	
	else
	{
	
		preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $figura["name"], $ext);

	
		$imagem_nome = md5(uniqid(time())) . "." . $ext[1];

		$imagem_dir = "fotos/" . $imagem_nome;

		move_uploaded_file($figura["tmp_name"], $imagem_dir);

		echo "Sua foto foi enviada com sucesso!";
	}
}
}

?>
