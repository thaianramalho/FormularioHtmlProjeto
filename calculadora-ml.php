<?php
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
// variáveis criadas apenas para salvar os valores dos inputs e não resetar os valores dos inputs após clicar em submit
$quantidadeR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['quantidade'] : "";
$produtoR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['produto'] : "";
$notaFiscalR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['notaFiscal'] : "";
$freteR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['frete'] : "";
$despesasR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['despesas'] : "";
$classicoR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['classico'] : "";
$premiumR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['premium'] : "";
$vendaR = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST['venda'] : "";

$calculoclassico = calculoAnuncioClassico($custo, porcentagem($notaFiscal,$venda), porcentagem($classico, $venda), $frete, $despesas, $venda);
$totalclassico = number_format(($venda - $calculoclassico), 2);

$calculopremium = calculoAnuncioPremium($custo , porcentagem($notaFiscal,$venda), porcentagem($premium, $venda), $frete, $despesas, $venda);
$totalpremium = number_format(($venda - $calculopremium), 2);

// função de porcentagem (usada na nota fiscal)
function porcentagem($porcentagem, $venda){
    return ($porcentagem / 100) * $venda;
}

// função que valida o limite do valor da taxa do mercado livre (a partir de 79 reais ele para de cobrar 5 reais de taxa)
function validaLimiteDeTaxa($valorDaVenda)
{
    if ($valorDaVenda < VALOR_LIMITE_TAXA) {
        return TAXA_VALOR_INFERIOR;
    }
    return TAXA_VALOR_SUPERIOR;
}
//calculando anuncio no plano clássico
function calculoAnuncioClassico($custo, $notaFiscalPorcentagem, $classicoPorcentagem, $frete, $despesas, $venda)
{
    return $custo + $notaFiscalPorcentagem + $classicoPorcentagem + $frete + $despesas + validaLimiteDeTaxa($venda);
}
//calculando anuncio no plano premium
function calculoAnuncioPremium($custo, $notaFiscalPorcentagem, $premiumPorcentagem, $frete, $despesas, $venda)
{
    return $custo + $notaFiscalPorcentagem + $premiumPorcentagem + $frete + $despesas + validaLimiteDeTaxa($venda);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Calculadora - Mercado Livre</title>
    <meta name="theme-color" content="#5850fe">
    <link rel="icon" type="image/png" sizes="640x426" href="assets/img/ML%20Logo.png">
    <link rel="icon" type="image/png" sizes="640x426" href="assets/img/Excel%20logo.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/aguilaraldo1_section_contact.css">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Contact-form-simple.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form-1.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Header-Dark.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Projects-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg navigation-clean" style="background: rgb(241,247,252);">
        <div class="container"><a class="navbar-brand" href="index.php">Cálculo Fácil</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="ferramentas.html">Ferramentas</a></li>
                    <li class="nav-item"><a class="nav-link" href="contato.html">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="login-clean" title="Quantidade" style="background: rgb(241, 247, 252);">
        <form method="post" name="cad" action="#resultado">
            <h2 class="text-center">Calculadora Mercado Livre</h2>
            <div class="illustration">
                <i class="icon ion-ios-calculator" style="border-color: #5850fe;color: #5850fe;"></i></div>
                <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" name="quantidade" id="quantidade" min="0" value="<?php echo $quantidadeR ?>" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;" min="1">
                <label for="quantidade" class="labelInput">Quantidade</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $produtoR ?>" name="produto" id="produto" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;" min="1">
                <label for="produto" class="labelInput">Custo do produto (R$)</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $notaFiscalR ?>" name="notaFiscal" id="notaFiscal" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                <label for="notaFiscal" class="labelInput">Imposto da Nota Fiscal (%)</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $despesasR ?>" name="despesas" id="despesas" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                <label for="despesas" class="labelInput">Despesas de venda (R$)</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $freteR ?>" name="frete" id="frete" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                <label for="frete" class="labelInput">Valor do frete (R$)</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $classicoR ?>" name="classico" id="classico" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                <label for="classico" class="labelInput">Tarifa Clássico (%)</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $premiumR ?>" name="premium" id="premium" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                <label for="premium" class="labelInput">Tarifa Premium (%)</label></div>
            <div class="mb-4 inputBox">
                <input autocomplete="off" class="border rounded-pill shadow-sm form-control inputUser" type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" value="<?php echo $vendaR ?>" name="venda" id="venda" min="0" required inputmode="numeric" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;" min="1">
                <label for="venda" class="labelInput">Valor do anúncio (R$)</label></div>
            <div class="mb-4 inputBox">
                <button class="btn btn-primary d-block w-100" type="submit" id="submit" style="background: #5850fe;">Calcular</button></div>
                <!-- <button class="mb-5 btn btn-primary d-block w-100" type="reset" style="background: #5850fe;margin: 5px 0px 0px;">Limpar</button> --><br>
            <section id="resultado">
                <div class="mb-5 inputBox">
                    <div class="inputUserResultado inputBox">
                        <p class="smallTitle">Clássico - (Lucro líquido)</p>
                        <input class="border rounded-pill shadow-sm form-control mb-4" readonly name="resultadoClassico" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                        <b><label for="resultadoClassico" class="resultadoInput"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'R$'.$totalclassico : "" ?></label></b></div>
                        <div class="inputUserResultado inputBox">
                        <p class="smallTitle">Premium - (Lucro líquido)</p>
                        <input class="mb-4 border rounded-pill shadow-sm form-control" readonly name="resultadoPremium" style="border-color: #5850fe;--bs-primary: #5850fe;--bs-primary-rgb: 88,80,254;">
                        <b><label for="resultadoPremium" class="resultadoInput"><?php echo ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'R$'.$totalpremium : "" ?></label><b></div>
                </div>
            </section>
        </form>
    </section>
    <footer class="footer-basic" style="background: rgb(241,247,252);">
        <div class="social">
            <!-- <a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a> -->
        </div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="index.php">Início</a></li>
            <li class="list-inline-item"><a href="ferramentas.html">Ferramentas</a></li>
            <li class="list-inline-item"><a href="contato.html">Contato</a></li>
        </ul>
        <p class="copyright">Cálculo Fácil © 2022</p>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>