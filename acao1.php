<?php
$Tipo = $_GET['Tipo'];
$idusuario = $_GET['pessoas'];

@$conexao = pg_connect("host=localhost port=5432 dbname=novo user=postgres password=JovemP*2023"); //Linha de conexão
pg_set_client_encoding($conexao, 'UNICODE');

if ($Tipo == "ED"):
    $select = "SELECT pessoas .pessoas, pessoas.nome, pessoas.senha, pessoas.id_cidade, pessoas.email
        FROM pessoas
        WHERE pessoas.pessoas = $idusuario";
    
    $resultado = pg_query($conexao, $select);
    while ($linha = pg_fetch_array($resultado)){
        $idusuario = $linha[0];
        $nomeusuario = $linha[1];
        $senhausuario = $linha[2];
        $cidadeusuario = $linha[3];
        $emailusuario = $linha[4];

        echo "<script language='javascript'>
                window.parent.document.getElementById('idusuario').value='$idusuario';
                window.parent.document.getElementById('nomeusuario').value='$nomeusuario';
                window.parent.document.getElementById('senhausuario').value='$senhausuario';
                window.parent.document.getElementById('cidadeusuario').value='$cidadeusuario';
                window.parent.document.getElementById('emailusuario').value='$emailusuario';
            </script>";
    }
elseif ($Tipo == 'EX'):
    $delete = "DELETE FROM pessoas 
        WHERE pessoas.pessoas = $idusuario"; echo $delete;
        
    pg_query($conexao, $delete);

    echo "<script language='javascript'>alert('Registro Excluído com Sucesso!');
        window.parent.listaRegistros();
        </script>";
endif;
?>