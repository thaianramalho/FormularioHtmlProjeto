var quantidade = document.getElementsByName("quantidade");
var notaFiscal = document.getElementsByName("imposto");
var despesas = document.getElementsByName("despesas");
var frete = document.getElementsByName("frete");
var classico = document.getElementsByName("classico");
var premium = document.getElementsByName("premium");
var venda = document.getElementsByName("venda");
var produto = document.getElementsByName("produto");
var custo = quantidade * produto;

const valorLimiteTaxa = 79;
const taxaValorSuperior = 0;
const taxaValorInferior = 5;

function calculoAnuncioClassico(custo, notaFiscalPorcentagem, classicoPorcentagem, frete, despesas, venda){
    return custo + notaFiscalPorcentagem + classicoPorcentagem + frete + despesas + validaLimiteDeTaxa(venda);
}

function calculoAnuncioPremium(custo, notaFiscalPorcentagem, premiumPorcentagem, frete, despesas, venda){
    return custo + notaFiscalPorcentagem + premiumPorcentagem + frete + despesas + validaLimiteDeTaxa(venda);
}

function validaLimiteDeTaxa(valorDaVenda){
    if (valorDaVenda < valorLimiteTaxa){
        return taxaValorInferior;
    }
    return taxaValorSuperior;
}

function porcentagem(porcentagem, venda){
    return (porcentagem / 100) * venda;
}

var calculoclassico = calculoAnuncioClassico(custo, porcentagem(notaFiscal,venda), porcentagem(classico, venda), frete, despesas, venda);
var totalclassico = (venda - calculoclassico);

var calculopremium = calculoAnuncioPremium(custo , porcentagem(notaFiscal,venda), porcentagem(premium, venda), frete, despesas, venda);
var totalpremium = (venda - calculopremium);