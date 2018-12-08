<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>API Cursos</title>
  </head>
  <body style="background:#ccc;">
    <?php
    include 'header.php';
    
    if(isset($_GET['id']) && $_GET['id'] <> ''){	
        $id = $_GET['id'];
        $dados = json_decode(file_get_contents('http://localhost:88/curso/api/curso/read_one.php?idcurso='.$id));
        $professores = json_decode(file_get_contents('http://localhost:88/curso/api/professor/read.php'));
        $salas = json_decode(file_get_contents('http://localhost:88/curso/api/sala/read.php'));
    
        
    }
   
    
    ?>
    
    
    <div class="container" style="margin-top:20px;">
    
        <div class="card">
        
        <h5 class="card-header text-center"><div class="float-left"><a href="index.php" class="bt bt-primary"><i class="fas fa-arrow-left"></i></a></div>Editar Detalhes do Curso</h5>
                <div class="card-deck"> 
                    <div class="container">  
                        <form action="#" method="get" id="enviar">
                            <input type="hidden" name="idcurso" class="form-control" id="idcurso" value="<?=$dados->idcurso;?>">
                            <div class="form-row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top:10px;">

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"  style="margin-top:10px;">
                                    <input type="text" name="curso" class="form-control" id="curso" placeholder="Nome do Curso" value="<?=$dados->curso;?>" required>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"  style="margin-top:10px;">
                                    <select name="idprofessor" class="form-control" id="idprofessor" placeholder="Professores" required>
                                    <?php foreach($professores->records as $valor){
                                       if($valor->idprofessor == $dados->idprofessor){
                                            echo '<option value="'.$valor->idprofessor.'" selected>'.$valor->professor.'</option>';
                                       }else{
                                            echo '<option value="'.$valor->idprofessor.'">'.$valor->professor.'</option>';
                                       }
                                     } ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="margin-top:10px;" required>
                                    <select name="idsala" class="form-control" id="idsala" placeholder="Salas">
                                    <?php foreach($salas->records as $valor){
                                        if($valor->idsala == $dados->idsala){
                                            echo '<option value="'.$valor->idsala.'" selected>'.$valor->sala.'</option>';
                                        }else{
                                            echo '<option value="'.$valor->idsala.'">'.$valor->sala.'</option>';
                                        }
                                     } ?>
                                    </select>
                                </div>

                                <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3" style="margin-top:10px;">
                                    <input type="text" name="inicio" class="form-control" id="inicio" placeholder="Inicio" value="<?=$dados->inicio;?>" required>
                                </div>

                                <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3" style="margin-top:10px;">
                                    <input type="text" name="fim" class="form-control" id="fim" placeholder="Fim" value="<?=$dados->fim;?>" required>
                                </div>

                            </div>
                            
                            <div class="row justify-content-center" style="margin-top:10px;">    
                                <button type="submit" class="btn btn-primary col-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>
         </br>
        </div>
       
    </div>
    <script>
            
            $( 'form#enviar').on('submit', function(){
                    // get form data
                    var form_data=JSON.stringify($(this).serializeObject());
                    
                   // submit form data to api
                        $.ajax({
                            url: "/curso/api/curso/update.php",
                            type : "POST",
                            contentType : 'application/json',
                            data : form_data,
                            success : function(result) {
                                                              
                                $("#message").html(
                                                    '<h7 class="text-success">'
                                                        + result.message +
                                                    '</h7>');
                                
                                setTimeout(function () { window.location.href = "index.php" }, 4000);
                               
                            },
                            error: function(xhr, resp, text) {
                                // show error to console
                                alert('erro');
                            }
                        });
                        
                        return false;
                });
  
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-serialize-object/2.5.0/jquery.serialize-object.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   
    
</body>
</html>