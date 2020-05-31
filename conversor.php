<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./image/logo.png" />
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
    <script src="./_json/jquery.js"></script>
    <script src="./_json/conversor.js"></script>
</body>

</html>