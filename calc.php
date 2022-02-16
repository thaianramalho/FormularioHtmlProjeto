<?php
include ("./formulario.html");
if ($_POST) {
    $quantidade = $_POST['quantidade'];
    $produto = $_POST['produto'];
    $notaFiscal = $_POST['notaFiscal'];
    $despesas = $_POST['despesas'];
    $frete = $_POST['frete'];
    $classico = $_POST['classico'];
    $premium = $_POST['premium'];
    $venda = $_POST['venda'];

    $custo = $quantidade * $produto;

    $notaFiscalPorcentagem = ($notaFiscal / 100) * $venda;

    if ($venda < 79) {
        $classicoPorcentagem = ($classico / 100) * $venda + 5;
        $premiumPorcentagem = ($premium / 100) * $venda + 5;
    }
    else if ($venda >=80) {
        $classicoPorcentagem = ($classico / 100) * $venda;
        $premiumPorcentagem = ($premium / 100) * $venda;
    };

    $calculoclassico = $custo + $notaFiscalPorcentagem + $classicoPorcentagem + $frete + $despesas;
    $totalclassico = $venda - $calculoclassico;

    $calculopremium = $custo + $notaFiscalPorcentagem + $premiumPorcentagem + $frete + $despesas;
    $totalpremium = $venda - $calculopremium;


    echo 'Lucro do anúncio Clássico: ' . $totalclassico ."<br>". 'Lucro do anúncio Premium: ' . $totalpremium;
}


?>