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

    <!-- <link rel="stylesheet" type="text/css" href="styile.css"/> -->

    <title>Calculadora de anúncios</title>
</head>

<body>
    <div class="fundo">
        <h1>Calculadora de anúncios</h1><br>
        <div class=calculadora>
            <form name="cad" method="POST" action="calc.php">
                <p>Quantidade:</p>
                <input placeholder="Ex: 1" type="number" name="quantidade" min="1" value="1" required><br>

                <p>Custo do produto:</p>
                <input placeholder="Ex: 15,00" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="produto" min="1" value="20" required><br>

                <p>Imposto da NF-E:</p>
                <input placeholder="Ex: 4 (sem porcentagem)" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="notaFiscal" min="0" value="7" required><br>

                <p>Despesas:</p>
                <input placeholder="Ex: 5,00" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="despesas" min="0" value="10"><br>

                <p>Valor do frete:</p>
                <input placeholder=" Ex: 20,00" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="frete" min="0" value="50"><br>

                <p>Tarifa Clássico:</p>
                <input placeholder="Ex: 11,5 (sem porcentagem)" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="classico" min="1" value="11.5" required><br>

                <p>Tarifa Premium:</p>
                <input placeholder="Ex: 16,5 (sem porcentagem)" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="premium" min="1" value="17" required><br>

                <p>Preço de venda:</p>
                <input placeholder="Ex: 250,00" pattern="[0-9]+([,\.][0-9]+)?" step="any" type="number" name="venda" min="1" value="250" required><br>
                <br>
                <input type="submit" value="Calcular">
                <input type="reset" value="Limpar">
                <br><br>
                <div>
                    <h4><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'Lucro líquido clássico: R$' . $totalclassico : "" ?></h4>
                    <h4><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'Lucro líquido premium: R$' . $totalpremium : "" ?></h4>

                </div>

            </form>

        </div>
    </div>
</body>

</html>