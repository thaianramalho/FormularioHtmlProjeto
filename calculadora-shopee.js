// constantes
const valorLimiteTaxa = 79;
const taxaSemFreteGratis = 12;
const taxaComFreteGratis = 18;
const valorLimiteComissaoShopee = 18;

// definindo variáveis
var quantidade = document.getElementsByName("quantidade");
var produto = document.getElementsByName("produto");
var notaFiscal = document.getElementsByName("imposto");
var despesas = document.getElementsByName("despesas");
var venda = document.getElementsByName("venda");
var custo = quantidade * produto;

//Conta: Preço de venda - (Preço de custo + Porcentagem da nota referente ao preço de venda + Despesas + Taxa Shopee 12% ou 18%)

// função de porcentagem (usada na nota fiscal)
function porcentagem(porcentagem, venda){
    return (porcentagem / 100) * venda;
}

// função da taxa sem frete grátis
function taxaSemFreteGratis(venda){
    if ((taxaSemFreteGratis / 100) * venda < valorLimiteComissaoShopee){
        return (taxaSemFreteGratis / 100) * venda;
    }
    return valorLimiteComissaoShopee;
}

// função da taxa com frete grátis
function taxaComFreteGratis(venda){
    if ((taxaComFreteGratis / 100) * venda < valorLimiteComissaoShopee){
        return (taxaComFreteGratis / 100) * venda;
    }
    return valorLimiteComissaoShopee;
}

// inserindo cálculos em variáveis
totalSemFrete = (venda - (custo + porcentagem(notaFiscal, venda) + despesas + taxaSemFreteGratis(venda)));

totalComFrete = (venda - (custo + porcentagem(notaFiscal, venda) + despesas + taxaComFreteGratis(venda)));