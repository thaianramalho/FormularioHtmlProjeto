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
    $calculoclassico = $custo + $notaFiscal + $classico + $frete + $despesas;
    $totalclassico = $venda - $calculoclassico;

    $calculopremium = $custo + $notaFiscal + $premium + $frete + $despesas;
    $totalpremium = $venda - $calculopremium;

    echo $totalclassico;
    echo $totalpremium;
}


?>