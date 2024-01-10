<?php

require_once '../conexao_banco.php';

$idrp = $_POST['id'];

?>
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="title" id="defaultModalLabel">Perguntas</h4>
        </div>
        <div class="modal-body">

            <form class="forms-sample">
                <div class="form-group">

                    <label for="tipopergunta">Tipo de pergunta*</label>
                    <select class="form-control show-tick selectpicker" id="tipopergunta">
                        <option selected value="">[Selecione]</option>
                        <option value="dissertativa">Dissertativa</option>
                        <option value="data">Data</option>
                        <option value="numerointeiro">Numero inteiro</option>
                        <option value="numerodecimal">Numero decimal</option>
                        <!-- <option value="calculo">Calculo</option> -->
                        <!-- <option value="porcentagem">Porcentagem</option> -->
                    </select>

                    <div id="divprincipal" style="display: none">

                        <label for="titulopergunta" id="titulolabel"></label>
                        <textarea id="titulopergunta" class="form-control" obrigatorio="1" rows="3" style="height: auto !important"></textarea>

                        <div id="divzero" style="display: none">
                            <label for="zero">Numero pode ser zero?*</label>
                            <select class="form-control show-tick selectpicker" id="zero" obrigatorio="1">
                                <option value="">[Selecione]</option>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>


                    </div>
                    <!-- <div id="calculo">
                            <?php
                            // $somarnumeroint = 0;
                            // $cmdp = "SELECT jsonperguntas
                            //         FROM RelatorioPerguntas
                            //         WHERE id = '$idrp'";
                            // $resultp = mysqli_query($link, $cmdp);
                            // $dadosp = mysqli_fetch_array($resultp);
                            // if (isset($dadosp)) {
                            //     $jsoncalculo = json_decode($dadosp['jsonperguntas']);

                            //     if (isset($jsoncalculo->perguntas) && is_array($jsoncalculo->perguntas)) {
                            //         foreach ($jsoncalculo->perguntas as $pergunta) {
                            //             if ($pergunta->tipopergunta == 3 || $pergunta->tipopergunta == 4) {
                            //                 echo "<option value='{$pergunta->pergunta}'>{$pergunta->pergunta}</option>";
                            //             }
                            //         }
                            //     }






                            // while ($jsoncalculo) {
                            //     if ($jsoncalculo->tipopergunta == '3' || $jsoncalculo->tipopergunta == '4') {
                            //         $somarnumeroint++;
                            //         // $row_cntc = mysqli_num_rows($jsoncalculo);
                            //     }
                            // }if($somarnumeroint >= 2){ 
                            ?>

                                        

                                <?php //}
                                //sem perguntas criadas
                                //}
                                ?>
                        </div> -->
                </div>
                <button type="button" id="buttoninserirrelatorioperguntas" onclick="salvarPergunta(<?= $idrp ?>)" class="btn btn-primary me-2">Confirmar</button>
                <button type="button" class="btn btn-light" onclick="fecharmodalPerguntas()">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#tipopergunta').on('change', function() {
            const tipopergunta = $(this).val();
            if (tipopergunta === '') {
                $('#divprincipal').hide();
            } else {
                $('#divprincipal').show();
                switch (tipopergunta) {
                    case 'dissertativa':
                        tipoperguntalabel = 'DISSERTATIVA*';
                        $('#divzero').hide();
                        console.log('pergunta dissertativa');
                        break;
                    case 'data':
                        tipoperguntalabel = 'uma DATA*';
                        $('#divzero').hide();
                        console.log('pergunta data');
                        break;
                    case 'numerointeiro':
                        tipoperguntalabel = 'um NÚMERO INTEIRO*';
                        $('#divzero').show();
                        console.log('pergunta numero int');
                        break;
                    case 'numerodecimal':
                        tipoperguntalabel = 'um NÚMERO DECIMAL*';
                        $('#divzero').show();
                        console.log('pergunta numero decimal');
                        break;
                    case 'porcentagem':
                        tipoperguntalabel = 'uma PORCENTAGEM*';
                        $('#divzero').show();
                        console.log('pergunta porcentagem');
                        break;
                    default:
                }
                $('#titulolabel').text("Insira a pergunta cuja resposta seja " + tipoperguntalabel);
            }
        });
    });
</script>

<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>