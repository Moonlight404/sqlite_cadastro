<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
    <div class="erros">
        <div class="pop" v-for="erro in erros">
            <span>{{ erro.erro }}</span>
            <div class="progress">
                <div class="sub" :style="{width: `${erro.progress}%`}"></div>
            </div>
        </div>
    </div>
    <form 
    v-if="cadastrare"
    v-on:submit.prevent="cadastrar">
        <label for="nome">Nome</label>
        <input type="text"
                       name="nome"
                       id="nome"
                       v-model="user.nome"
                       placeholder="Nome">
        <label for="email">E-mail</label>
        <input type="email" 
                       name="valor"
                       id="valor" 
                       v-model="user.email"
                       placeholder="Email">
        <label for="login">Login</label>
        <input type="text"
                       name="login"
                       id="login"
                       v-model="user.login"
                       placeholder="Login">
        <label for="senha">Senha</label>
        <input type="password" 
                       name="senha"
                       id="senha" 
                       v-model="user.senha"
                       placeholder="Senha">
        <label for="senha">Confirmar senha</label>
        <input type="password" 
                       name="senha-confirma"
                       id="senha" 
                       v-model="user.confirma"
                       placeholder="Confirmar senha">
        <button type="submit"
                        name="salvar"
                        id="salvar">Salvar</button>
        <a style="color: #fff; position: relative;
         top: 15px; cursor: pointer;" @click="listarUsuarios">Usuarios cadastrados</a>
    </form>
    <div class="certeza" :class="{ou : excluindo}">
        <div class="excluir" :class="{outing: excluindo}">
            <h1>Tens certeza?</h1>
            <p>Tens certeza que queres excluir o nome</p>
            <button class="red" @click="deletee">Sim</button>
            <button @click="excluindo = false">Não</button>
        </div>
    </div>
    <form v-on:submit.prevent="nothing" class="lista"  v-if="!cadastrare">
    <div class="scroll">
        <li v-if="usuarios.length == 0">
        <td>Nenhum usuario cadastrado</td>
        </li>
    <tr>
            <li v-for="i in usuarios">
            <td>
                <span v-if=" editandoQuem != i">{{ i.email }}</span>
                <input v-model="editandoQuem.email" v-else="" type="text" placeholder="E-mail">
            </td>
            <br>
            <td>
                <span v-if="editandoQuem != i">{{ i.login }}</span>
                <input v-model="editandoQuem.login" v-if="editando && editandoQuem == i" type="text" placeholder="Usuario">
            </td>
            <td>
                <button @click="deletar(i)"><i class="fas fa-user-minus"></i></button>
                <button v-if="editando && editandoQuem == i" @click="save"><i class="fas fa-save"></i></button>
            </td>
            <td>
                <button v-if="!editando" @click="editar(i)"><i class="fas fa-edit"></i></button>
            </td>
            </li>
        </tr>
        </div>    
        <a style="color: #fff; position: relative;
         top: 15px; cursor: pointer;" @click="cadastrare = true">Cadastrar</a>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="js/index.js"></script>
</body>
</html>