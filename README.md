## Projeto LTW 2023/2024 

### Motivação
Este projeto foi realizado no âmbito da cadeira "Linguagens e Tecnologia Web" da Licenciatura de Engenharia Informática e Programação da Faculdade de Engenharia e Universidade do Porto. 
Para este ano letivo, foi proposto criarmos um website, cujo o tema era "Venda de Artigos em Segunda-Mão", pondendo ser possível consolidar todas as competências adquiridas nesta cadeira.

### Contribuição
* Jorge Mesquita (up202108614)

### ReTreasure
ReTreasure é o nome do meu website, cuja a missão é criar uma network onde os utilizadores podem comprar e/ou vender artigos em segunda-mão. A nossa missão é promovermos a sustentabilidade e reduzirmos o consumismo, um problema bastante prevalente na nossa sociedade!

### Tópicos
- HTML
- CSS
- PHP
- JavaScript
- Segurança
- Noções Gerais

### HTML
O primeiro desafio diz respeito a criação do layout das páginas e estruturar de forma correta, respeitando sempre as regras universais e as boas práticas.
#### Head
Para respeitarmos as regras do HTML, é importante definirmos bem a head de todas as páginas, atribuindo os parâmetros imprescendíveis. 
É importante utilizarmos a tag META e o charset "UTF-8" para providenciarmos compatibilidade com todos caracteres. Além disso, é importante atribuirmos a ligação correta com os ficheiros CSS e JavaScript.
<img src="/images/1.png">

#### Form
Quando é necessário fazer a ligação entre a interação website-utilizador, um dos métodos mais eficazes é definirmos a action, escrita em PHP, e associarmos a mesma ao FORM.
<img src="/images/2.png">

### CSS
O desafio seguinte é definirmos a parte visual de cada página, criando um ficheiro CSS. É importante definirmos um design uniforme e acessível. No meu design, utilizei diversas propriedades, como o grid, flex e também o uso de @keyframe.
<img src="/images/3.png">
<img src="/images/4.png">
<img src="/images/6.png">

### PHP
O desafio mais longo foi, sem dúvida, criar o HTML a partir de templates e fazer a ligação entre o website e o servidor, nomeadamente com a base de dados. Além disso, o PHP foi essencial para o uso de API's externas, como a conversão de moedas.
<img src="/images/5.png">

### JavaScript
Uma das partes mais interessantes deste projeto foi criar uma search bar dinâmica e interativa e, também, atualizar contéudas da página sem ser necessário fazer refresh.
<img src="/images/7.png">
<img src="/images/8.png">

### Segurança
Estando o nosso website quase pronto, é essencial revermos alguns aspetos que podem compremeter a nossa segurança. 

#### Password Storage
Neste ponto, é crucial optarmos por estratégias que tornam as palavras-passe mais seguras. O PHP dispõe de dois métodos, como o password_hash() e password_verify(), que facilitam este procedimento.
<img src="/images/9.png">
<img src="/images/10.png">
#### Invalidação do Access
Existem certas páginas que não queremos que sejam acessíveis a qualquer utilizador, nomeadamente a manutenção por parte dos administradores e também a interação com a nossa loja online por utilizadores não registados.
<img src="/images/11.png">
<img src="/images/12.png">
#### Injection Prevention
Por vezes, quando um utilizador introduz algum tipo de contéudo, seja um comentário ou o registo de um artigo, podemos correr o risco de scripts serem injetados no nosso website, pondo em causa a nossa segurança. 
Para previnir isso, o PHP dispõe de alguns métodos bastante úteis, como o htmlentities() e o htmlspecialchars(), convertendo carcteres críticos do HTML em códigos que não interferem no mesmo.
<img src="/images/13.png">
#### SQL Injection
Um ponto crucial é impedirmos a injeção de dados ou queries nocivas na nossa bade de dados que podem comprometer a nossa segurança. Desta forma, o PHP dispõe de uma classe de objetos PDO que permite tornar a ligação à base de dados mais segura.
<img src="/images/14.png">
<img src="/images/15.png">

### Noções Gerais
Este foi um dos projetos onde adquiri diversas competências durante a sua realização. Foi possível explorar novos conceitos, indo para além das competências da unidade curricular, e, essencialmente, foi possível consolidar as competências adquiridas.
Cumpri 100% dos parâmetros obrigatórios e explorei alguns opcionais, como a realização de comentários num artigo e a conversão entre moedas. 
Posto isto, considero que este projeto foi bem sucedido e tive uma boa prestação!
