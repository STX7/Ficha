<?php
	session_start();
	require("conexao.php");
	$id = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body style="background-color:#BEC8E3;">		



<div class="container" class="col-12">

    <!-- Menu  --------------------------------- -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="menu_servidor.php">Menu</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              
            <li class="nav-item">
                <a class="nav-link" href="Tutorial_fichacat_2011.pdf">Informações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Alterar dados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ficha_usuario.php">Gerar ficha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="historico.php">Histórico</a>
            </li>
            
      </ul>
  </div>
</nav>


<div style="background-color:#ffffff">

  	<?php

	$lista = $conexao->prepare("select * from ficha where ficha.status = 1 or ficha.status = 0");
	$lista->execute();
	$itens = $lista->fetchAll(PDO::FETCH_OBJ);
    echo "<table class='table'>
  <thead >
    <tr>
      <th scope='col'> </th>
      <th scope='col'>Nome</th>
      <th scope='col'>Titulo</th>
      <th scope='col'> </th>
      <th scope='col'> </th>
    </tr>
  </thead>
  <tbody>";
    if (empty($itens)) {
       echo "<tr><th scope='row'></th><th scope='row'>Você não possui fichas cadastradas</th></tr>";
    }
    else{
        
    foreach ($itens as $item) {
        if ($item->status == 0) {
          echo "<tr>
      <th scope='row'></th>
      <td>$item->n_autor1</td>
      <td>$item->titulo</td>
      <td><a href='editar.php?id=$item->id'><img alt='Editar'  src='.\\img\\pen.svg' height='50' width='50'></a></td>
      <td><a href='excluir.php?id=$item->id'><img alt='Excluir'  src='.\\img\\x-lg.svg' height='50' width='50'></a></td>
    </tr>";  
        }
        if ($item->status == 1) {
           echo "<tr class='table-warning'>
      <th scope='row'></th>
      <td>$item->n_autor1</td>
      <td>$item->titulo</td>
      <td><a href='editar.php?id=$item->id'><img alt='Editar'  src='.\\img\\pen.svg' height='50' width='50'></a></td>
      <td><a href='excluir.php?id=$item->id'><img alt='Excluir'  src='.\\img\\x-lg.svg' height='50' width='50'></a></td>
    </tr>"; 
        }
        if ($item->status == 2) {
           echo "<tr class='table-info'>
      <th scope='row'></th>
      <td>$item->n_autor1</td>
      <td>$item->titulo</td>
      <td><a href='editar.php?id=$item->id'><img alt='Editar'  src='.\\img\\pen.svg' height='50' width='50'></a></td>
      <td><a href='excluir.php?id=$item->id'><img alt='Excluir'  src='.\\img\\x-lg.svg' height='50' width='50'></a></td>
    </tr>"; 
        }
        
    }

    }
    echo "</tbody></table>";
	
?>
  



</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>		