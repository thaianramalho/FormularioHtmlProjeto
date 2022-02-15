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

    $total = $quantidade + $produto + $notaFiscal + $despesas + $frete + $classico + $premium + $venda;
    echo $total;
}


?>