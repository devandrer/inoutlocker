<?php 
  session_start();
  include('php/funcoes.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="dist/img/Logo_InOutLocker.ico">
  <title>Portas</title>

  <!-- CSS -->
  <?php include('partes/css.php'); ?>
  <!-- Fim CSS -->

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('partes/navbar.php'); ?>
  <!-- Fim Navbar -->

  <!-- Sidebar -->
  <?php 
    $_SESSION['menu-n1'] = 'administrador';
    $_SESSION['menu-n2'] = 'porta';
    include('partes/sidebar.php');
  ?>
  <!-- Fim Sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <!-- Espaço -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  
                <div class="col-9">
                    <h3><i class="bi bi-door-open-fill nav-icon mr-2"></i>Portas</h3> 
                  </div>
                  
                  <div class="col-3" align="right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#novaPortaModal">
                      Nova Porta
                    </button>
                  </div>

                </div>
              </div>

              

              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabela" class="table table-bordered table-hover">
                  <thead class="thead-dark">
                  <tr> <!-- tabela das informações principais da portas -->
                      <th>ID</th>
                      <th>Nr da Porta</th>
                      <th>Armario</th>
                      <th>Status</th>
                      <th>Ativo</th>
                      <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php echo listaPortas(); ?> <!-- faz o select no banco de dados, puxando as infos da portas (php/funcaoProta.php)-->
                  
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
       

      <!-- modal de adicionar nova porta -->

      <div class="modal fade" id="novaPortaModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Nova Porta</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="php/salvarPorta.php?funcao=I" enctype="multipart/form-data"><!-- faz a inserção de uma nova porta -->              
                
                <div class="row">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="iNrPorta">Nr da Porta:</label>
                      <input type="text" class="form-control" id="iNrPorta" name="nNrPorta" maxlength="50">
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="iArmario">Armário:</label>
                      <select name="nArmario" id="iArmario" class="form-control" required>
                        <option value="">Selecione um armário</option>
                        <?php echo optionPorta(); ?> <!-- Busca e mostra as portas dos armários cadastrados na mesma empresa que o usuario logado (php/funcaoPorta.php) -->
                      </select>
                    </div>
                  </div>

                  <div class="col-6">
                    <div class="form-group">
                      <label for="iStatus">Status:</label>
                      <select name="nStatus" id="iStatus" class="form-control" required>
                        <option value="D">Disponível</option>
                        <option value="I">Indisponível</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-12 mt-2">
                    <div class="form-group">
                      <input type="checkbox" id="iAtivo" name="nAtivo" checked>
                      <label for="iAtivo">Porta Ativa</label>
                    </div>
                  </div>
                </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                  <button type="submit" name="btSalvaPorta" value="modal_salvar" class="btn btn-success">Salvar</button>
                </div>
                
              </form>

            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- JS -->
<?php include('partes/js.php'); ?>
<!-- Fim JS -->

<script>
  $(function () {
    $('#tabela').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
