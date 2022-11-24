<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/form.css">
    <title>Treinamento Forms</title>
</head>
<body>
    <div class="aviso" data-type="<?=$_SESSION['avisoType'];?>" style="display: none;">
        <?=$_SESSION['aviso'];?>
    </div>
    
    <?php 
        $_SESSION['avisoType'] = '';
        $_SESSION['aviso'] = '';
    ?>


    <form method="POST" action="model/formulario.php" enctype="multipart/form-data" class="form-style">
        <fieldset>
            <legend>Treinamento forms</legend>
            <h1>Formulário de contato</h1>
            <p>*são campos obrigatorios</p>
            <hr/>
            
            <div class="form-campos">
                <label>Foto:</label>
                <input type="file" name="foto" accept="image/jpg, image/jpeg, image/png, image/gif, image/svg">
            </div>

            <div class="form-campos">
                <label>*Nome:</label>
                <input type="text" name="nome" placeholder="Nome Completo" minlength="5" maxlength="10" required>
            </div>
        
            <div class="form-campos">
                <label>*Idade:</label>
                <input type="number" name="idade" min="1" max="18" required>
            </div>

            <div class="form-campos">
                <label>*Email:</label>
                <input type="email" name="email" value="contato@mail.com" readonly>
            </div>

            <div class="form-campos">
                <label>*Senha:</label>
                <input type="password" name="senha" minlength="5" maxlength="10" required>
            </div>

            <div class="form-campos">
                <label>*Data de Nascimento:</label>
                <input type="date" name="date" min="1980-07-01" max="2022-07-01" required>
            </div>

            <div class="form-campos">
                <label>Cor do avatar:</label>
                <input type="color" name="cor">
            </div>

            <div class="form-campos">
                <label>Sexo:</label>
                <div class="option-sexo">
                    <div class="option-sexo--item">
                        <input type="radio" name="sexo" value="Masculino">
                        <label>Masculino</label>
                    </div>
                    <div class="option-sexo--item">
                        <input type="radio" name="sexo" value="Feminino" checked>
                        <label>Feminino</label>
                    </div>
                </div>
            </div>

            <div class="form-campos">
                <label>*Interesse:</label>
                <div class="option-interresse">
                    <div class="option-interresse--item">
                        <input type="checkbox" name="html" value="html">
                        <label>HTML</label>
                    </div>

                    <div class="option-interresse--item">
                        <input type="checkbox" name="css" value="css">
                        <label>CSS</label>
                    </div>

                    <div class="option-interresse--item">
                        <input type="checkbox" name="php" disabled>
                        <label><i><s>PHP</s></i></label>
                    </div>
                </div>
            </div>

            <div class="form-campos">
                <label>Nivel de 0 a 10:</label>
                <input type="range" min="0" max="10" name="nivel">
                <label>Valor selecionado: <span>5</span></label>
            </div>

            <div class="form-campos">
                <label>Região</label>
                <select name="regiao">
                    <option value="sudeste" selected>Sudeste</option>
                    <option value="centroOeste">Centro Oeste</option>
                    <option value="norte">Norte</option>
                    <option value="sul">Sul</option>
                </select>
            </div>

            <div class="form-campos">
                <label>*Mensagem</label>
                <textarea name="msg" rows="10" cols="50" minlength="10" maxlength="500" required></textarea>
            </div>

            <div class="form-campos">
                <button>Enviar</button>
            </div>


        </fieldset>
    </form>
    <script type="text/javascript" src="assets/js/formValidate.js"></script>
</body>
</html>