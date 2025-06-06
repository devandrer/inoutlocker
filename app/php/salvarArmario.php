<?php
  //Ação que seleciona o submit entre Salvar e Fechar a Modal na tela Perfil.php
$acao = $_POST['btSalvaArmario'];  
    include('funcoes.php');

    // Declara  as variáveis de acordo com o "name"
    $idArmario   = $_GET["codigo"];
    $razao   = $_POST["nRazao"];
    $local        = $_POST["nLocal"];
    $funcao      = $_GET["funcao"];

    //Verifica se está ativo
    if($_POST["nAtivo"] == "on") $ativo = "S"; else $ativo = "N";

    include("conexao.php"); //Arquivo de conexão com o banco

    //Validar se é Inclusão ou Alteração
    if($funcao == "I"){
        //INSERIR
        
        switch($acao){
            //Salva todos os dados escritos ao clicar no botão Salvar
            case "modal_salvar":
                    //Busca o próximo ID na tabela
                $idArmario = proximoID("tb_armario","id_armario");
                //INSERT
                //Insere as informações
                $sql = "INSERT INTO tb_armario(  
                        id_armario,local,flg_ativo,id_empresa)
                        VALUES($idArmario,'$local','$ativo','$razao');";
                $result = mysqli_query($conn,$sql);
            case "modal_limpar":
                header('location: ../armario.php');
                break;

            default:
        }     

    }elseif($funcao == "A"){
        //UPDATE 

        switch($acao){
            //Salva todos os dados escritos ao clicar no botão Salvar
            case "modal_salvar":
                // Atualiza no banco
                $sql = "UPDATE tb_armario
                SET local = '$local',
                    flg_ativo = '$ativo',
                    id_empresa = '$razao'
                WHERE id_armario = $idArmario;";
                $result = mysqli_query($conn,$sql);
            case "modal_limpar":
                header('location: ../armario.php');
                break;

            default:
        }     
        

      
    }elseif($funcao == "D"){
        //DELETE 
        // Deleta o armario

        $sqlMov = "SELECT * 
                FROM tb_movimentacao mov
                INNER JOIN tb_porta por ON mov.id_porta = por.id_porta
                INNER JOIN tb_armario arm ON arm.id_armario = por.id_armario
                WHERE arm.id_armario = $idArmario";

        $resultMov = mysqli_query($conn,$sqlMov);

        if($resultMov->num_rows > 0){
            $_SESSION["deleteArmario"] = true;
        } else {
            $sql = "DELETE FROM tb_armario 
                    WHERE id_armario = $idArmario;";
            $result = mysqli_query($conn,$sql);
        }

    }
    
    
    mysqli_close($conn);

    header("location: ../armario.php");
?>