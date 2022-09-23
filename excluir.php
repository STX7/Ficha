<?php
	session_start();
	require("conexao.php");
	$conexao = conectar();
	$id = $_GET['id'];

	if (isset($_GET['excluir'])) { 
		if ($_GET['excluir'] == "excluir") { 
			$lista = $conexao->prepare("delete from ficha where ficha.id = '$id'");
			$lista->execute();
			$itens = $lista->fetchAll(PDO::FETCH_OBJ);
			header("Location:menu_servidor.php"); 
		}
	}
	
	$lista = $conexao->prepare("select * from ficha where '$id' = ficha.id");
	$lista->execute();
	$itens = $lista->fetch(PDO::FETCH_OBJ);
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light table" style="width:100%;">
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
            <a class="nav-link" href="https://suap.ifg.edu.br/">Suap</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ficha_usuario.php">Gerar ficha</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historico.php">Histórico</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
          </li>

        </ul>
      </div>
    </nav>
<br><br>
    <div class="container">

      <section class="vh-100">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                  <div class="card-body p-5">

                    <h2>Deseja excluir?</h2><br>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1cg">Titulo</label><br>
                      <label class="text-secondary"><?php echo "$itens->titulo"; ?></label>

                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1cg">Autor</label><br>
                      <label class="text-secondary"><?php echo "$itens->n_autor1"; ?></label>

                    </div>

					<a href="excluir.php?excluir=excluir" align="center">Excluir</a>

                  </div>
                </div>
              </div>
            </div>
      </section>

    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>