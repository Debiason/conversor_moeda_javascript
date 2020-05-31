<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./logo.png" />
    <title>Conversor Universal</title>
    <link rel="stylesheet" href="_css/estilo.css">
</head>

<body>
    <h1>Conversor de moeda</h1>
    <main>
        <div class="conteudo">
            <div class="pesquisa">
                <form>
                    <label for="siglaMoeda">Moeda</label>
                    <select id="siglaMoeda">
                    </select>
                </form>
            </div>
            <div class="pais">
                <h3 id="titulo-pais">País</h3>
                <div id="bandeira"></div>
                <div id="listagem"></div>
            </div>
            <div class="moeda">
                <h3>Moeda</h3>
                <div id="listagem2"></div>
            </div>

        </div>
        <div id="conversor">
            <h2 id="titulo"></h2>
            <input class="input" id="moedaA_valor" type="number" value=""></input>
            <input class="button" id="button" type="button" value="Converter" onclick="converter()"></input>
            <h2 id="cotacao"></h2>
            <h4 id="valor"></h4>
        </div>
    </main>

    <script src="jquery.js"></script>
    <script>
        //variaveis
        var moedaA_valor = "";
        var moedaB_valor = 0;
        var moedaA = "USD";
        var moedaB = "BRL";

        //Preenche as informações na tela
        $('#valor').html("Cotação do dia para moeda " + moedaA + " = R$ ");
        $('#titulo').html("Converter " + moedaA + " para " + moedaB);
        $('#cotacao').html("Valor Convertido: R$ ");

        ////pega arquivo Json e lê as siglas para o select
        $.getJSON('_json/moeda.json', function(data) {
            var elemento = "";
            elemento += '<option value="">Selecione</option>';
            sigla = Array();

            //Pega as siglas do arquivo
            $.each(data, function(i, valor) {

                sigla[i] = valor.siglaMoeda
            })

            //Filtra as siglas repetidas
            var arr = sigla;
            var novaArr = arr.filter((este, i) => arr.indexOf(este) === i);

            //insere no select
            $.each(novaArr, function(i, valor) {

                elemento += '<option value="' + valor + '">' + valor + '</option>';
            })

            $('#siglaMoeda').html(elemento);

        })

        //Pega a seleção do select para preencher a lista de países que usam a moeda
        $('#siglaMoeda').change(function(e) {
            nome = $(this).val();

            //Retira os espaços desnecessários
            moedaA = nome.trim();

            //Preenche as informações na tela
            $('#valor').html("Cotação do dia para moeda " + moedaA + " = R$ ");
            $('#titulo').html("Converter " + moedaA + " para " + moedaB);

            //Preenche a lista de países e nome da moeda
            $.getJSON('_json/moeda.json', function(data) {

                var elemento = "";
                var elemento2 = "";
                var elemento3 = "";
                var nomeMoeda = "";


                $.each(data, function(i, valor) {

                    if (nome === valor.siglaMoeda) {

                        elemento += '<li>' + valor.pais + '</li>';
                        elemento3 += '<img src="' + valor.bandeira + '">';

                        nomeMoeda = valor.nomeMoeda;
                    }

                })

                elemento2 += '<li>' + nomeMoeda + '</li>';

                $('#listagem').html(elemento);
                $('#listagem2').html(elemento2);
                $('#bandeira').html(elemento3);


            })
        })

        //Função para calcular as cotações
        function converter() {

            moedaA_valor = document.getElementById('moedaA_valor').value;

            let de_para = `${this.moedaA}_${this.moedaB}`;

            let url = `https://free.currconv.com/api/v7/convert?q=${de_para}&compact=ultra&apiKey=20741cb2f37fb4f4958d`;

            fetch(url)
                .then(res => {
                    return res.json()
                })
                .then(json => {
                    var cotacao = json[de_para];

                    var moedaB_valor = (parseFloat(this.moedaA_valor) * cotacao).toFixed(3);

                    $('#cotacao').html("Valor Convertido: R$ " + moedaB_valor);
                    $('#valor').html("Cotação do dia para moeda " + moedaA + " = R$ " + cotacao + ".");

                });

        }
    </script>
</body>

</html>