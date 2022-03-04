<?php
// include ("./formulario.html");
define('VALOR_LIMITE_TAXA', 79);
define('TAXA_VALOR_INFERIOR', 5);
define('TAXA_VALOR_SUPERIOR', 0);
$quantidade = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['quantidade'] : 0;
$produto = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['produto'] : 0;
$notaFiscal = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['notaFiscal'] : 0;
$frete = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['frete'] : 0;
$despesas = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['despesas'] : 0;
$classico = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['classico'] : 0;
$premium = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['premium'] : 0;
$venda = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['venda'] : 0;
$custo = $quantidade * $produto;

$calculoclassico = calculoAnuncioClassico($custo, porcentagem($notaFiscal,$venda), porcentagem($classico, $venda), $frete, $despesas, $venda);
$totalclassico = round($venda - $calculoclassico, 2);

$calculopremium = calculoAnuncioPremium($custo , porcentagem($notaFiscal,$venda), porcentagem($premium, $venda), $frete, $despesas, $venda);
$totalpremium = round($venda - $calculopremium, 2);

function porcentagem($porcentagem, $venda){
    return ($porcentagem / 100) * $venda;
}

function validaLimiteDeTaxa($valorDaVenda)
{
    if ($valorDaVenda < VALOR_LIMITE_TAXA) {
        return TAXA_VALOR_INFERIOR;
    }
    return TAXA_VALOR_SUPERIOR;
}

function calculoAnuncioClassico($custo, $notaFiscalPorcentagem, $classicoPorcentagem, $frete, $despesas, $venda)
{
    return $custo + $notaFiscalPorcentagem + $classicoPorcentagem + $frete + $despesas + validaLimiteDeTaxa($venda);
}

function calculoAnuncioPremium($custo, $notaFiscalPorcentagem, $premiumPorcentagem, $frete, $despesas, $venda)
{
    return $custo + $notaFiscalPorcentagem + $premiumPorcentagem + $frete + $despesas + validaLimiteDeTaxa($venda);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styile.css"/>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5201865439212405"
     crossorigin="anonymous"></script>
     

    <title>Calculadora de anúncios</title>
</head>

<body>
    <div class="box">
        <div class=calculadora>
            <form name="cad" method="POST" action="">
            <fieldset>
                <legend><b>Calculadora de anúncios</b></legend>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="quantidade" id="quantidade" min="1" class="inputUser" required>
                    <label for="quantidade" class="labelInput">Quantidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="produto" type="number" class="inputUser" name="produto" min="1" required>
                    <label for="produto" class="labelInput">Custo do produto</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="notaFiscal" type="number" class="inputUser" name="notaFiscal" min="0" required>
                    <label for="notaFiscal" class="labelInput">Imposto da NF-E</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="despesas" type="number" class="inputUser" name="despesas" min="0">
                    <label for="despesas" class="labelInput">Despesas da venda</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="frete" type="number" class="inputUser" name="frete" min="0">
                    <label for="frete" class="labelInput">Valor do frete</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="classico" type="number" class="inputUser" name="classico" min="1"required>
                    <label for="classico" class="labelInput">Porcentagem Clássico</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="premium" type="number" class="inputUser" name="premium" min="1" required>
                    <label for="premium" class="labelInput">Porcentagem Premium</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input pattern="[0-9]+([,\.][0-9]+)?" step="any" id="venda" type="number" class="inputUser" name="venda" min="1" required>
                    <label for="venda" class="labelInput">Preço de venda</label>
                </div>

                <br><br>
                <div class="inputBox">
                    <input type="submit" id="submit" value="Calcular">
                    <br><br>
                    <input type="reset" id="limpar" value="Limpar">
                </div>
                <div class="inputBox">
                    <br>
                    <input class="inputUserResultado" name="resultadoClassico" readonly>
                    <label for="resultadoClassico"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'Lucro líquido clássico: R$' . $totalclassico : "" ?></label>
                    <br>
                    <input class="inputUserResultado" name="resultadoPremium" readonly>
                    <label for="resultadoPremium"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'Lucro líquido premium: R$' . $totalpremium : "" ?></label>
                </div>
            </fieldset>
            </form>
        </div>
    </div>
</body>
</html>