# reposistema
Sistema beta de inserção simples de produtos, colaboradores e distribuidoras; Com a possibilidade de se criar relatórios que são respondidos por outros usuarios



Projeto de um sistema com placeholder: Sistema FVP, criado para trabalho de registro interno para pequenas empresas, conta com criação, alteração e exclusão de modulos... 
Para esse projeto foram criados 11 módulos que vão desde inserções basicas de categorias, tipo de peso e embalagem feitas para detalhar o modulo de produto; Temos tambem os modulos de colaboradores do sistema, revendas autorizadas e compras, que se interligam para criar uma arvore basica de registro logico
Temos tambem um modulo exclusivo para inserir produtos e todos seus detalhes, note que alguns modulos estão intriscicamente ligados um ao outro, sendo que não é possivel criar um colaborador sem coligar uma revenda a ele, assim como não é possivel criar  uma compra sem coligar com um produto ja existente no sistema
O sistema também conta com dois modulos irmãos, o modulo de criação de formulario e o modulo de resposta ao formulário criado, para criar um formulario precisamos de uma referencia perguntando se queremos falar sobre produtos ou revendas
após selecionar a referencia, será listado todos os resultados relacionados a essa referencia, note que tanto para produto como para revenda é possivel adicionar todos os registros encontrados no banco assim como é possivel selecionar os resultados desejados a partir de uma tabela que demonstra todos os resultados desejados...
No mais tambem temos a opção de exportar revendas, compras, produtos e/ou respostas de um relatorio após um ou mais usuarios responderem ao mesmo, a exportação é feita de duas formas diferentes, uma buscando o resultado de uma consulta e fazendo um loop com todos esses resultados e a segunda forma é criado manualmente para relatórios variando em relação 
as respostas dadas assim como referencias criadas e perguntas descritas, toda exportação do sistema é feita para o formato CSV.
O sistema se encontra em beta pois ainda precisa ter uma melhor segurança no sistema de login 
