const app = new Vue({
    el: "#app",
    data: {
        user: {
            "nome": "",
            "email": "",
            "login": "",
            "senha": "",
            "confirma": "",
        },
        erros: [],
        cadastrare: true,
        excluindo: false,
        usuarios: [],
        editando: false,
        editandoQuem: {},
        deletandoQuem: {}
    },
    methods: {
        cadastrar(){
            if(this.user.nome.length == 0 || this.user.email.length == 0 || this.user.login.length == 0 || this.user.senha.length == 0){
                if(this.erros.length < 5){
                const erro = {
                    "id": this.erros.length,
                    "erro": "Preencha os campos",
                    "progress": 100
                }
                this.erros.push(erro)
                const interval = setInterval(() => {
                    const id = this.erros.indexOf(erro)
                    this.erros[id].progress -= 10;
                    if(this.erros[id].progress == 0){
                        clearInterval(interval)
                        this.erros.splice(id, 1)
                    }
                }, 300);
            }
            }
            else if(this.user.senha !== this.user.confirma){
                if(this.erros.length < 5){
                const erro = {
                    "id": this.erros.length,
                    "erro": "Senha diferentes",
                    "progress": 100
                }
                this.erros.push(erro)
                const interval = setInterval(() => {
                    const id = this.erros.indexOf(erro)
                    this.erros[id].progress -= 10;
                    if(this.erros[id].progress == 0){
                        clearInterval(interval)
                        this.erros.splice(id, 1)
                    }
                }, 300);
            }
            } else{
                $.ajax({
                    method: 'post',
                    url: '/api.php?tipo=cadastrar',
                    data: `nome=${this.user.nome}&email=${this.user.email}&login=${this.user.login}&senha=${this.user.senha}`,
                    dataType: 'json',
                    success: function (data) {
                       
                    },
                    error: function (argument) {
                       
                    }
                });
                this.cadastrare = false
                if(this.usuarios.length > 0){
                const codigo = parseInt(this.usuarios[this.usuarios.length - 1].codigo )+ 1
                this.usuarios.push({
                    codigo: codigo,
                    "nome": this.user.nome,
                    "email": this.user.email,
                    "login": this.user.login,
                    "senha":this.user.senha,
                })
                } else{
                    this.listarUsuarios()
                    this.getListUser()
                }
                this.user = {
                    "nome": "",
                    "email": "",
                    "login": "",
                    "senha": "",
                    "confirma": "",
                }
           
            }
            
        } ,
        nothing(){

        },
        getListUser(){
            setTimeout(() => {
                this.usuarios = JSON.parse(localStorage.getItem("users"));
               }, 400);
        },
        listarUsuarios(){
            $.ajax({
                method: 'get',
                url: '/api.php?tipo=listar',
                dataType: 'json',
                success: function (data) {
                    localStorage.setItem("users", JSON.stringify(data))
                },
                error: function (argument) {
                   
                }
            });
            this.cadastrare = false
            this.getListUser()
        },
        save(){
            $.ajax({
                method: 'post',
                url: '/api.php?tipo=editar',
                data: `codigo=${this.editandoQuem.codigo}&nome=${this.editandoQuem.nome}&email=${this.editandoQuem.email}&login=${this.editandoQuem.login}&senha=${this.editandoQuem.senha}`,
                dataType: 'json',
                success: function (data) {
                    localStorage.setItem("users", JSON.stringify(data))
                },
                error: function (argument) {
                   
                }
            });
            this.editandoQuem = {};
            this.editando = false;
            $.ajax({
                method: 'get',
                url: '/api.php?tipo=listar',
                dataType: 'json',
                success: function (data) {
                    localStorage.setItem("users", JSON.stringify(data))
                },
                error: function (argument) {
                   
                }
            });
            const found = this.usuarios.find(e => e == this.editandoQuem)
            if(found){
                const id = this.usuarios.indexOf(found)
                this.usuarios [id] = this.editandoQuem
            }
        },
        editar(people){
            this.editandoQuem = people
            this.editando = true
        },
        deletee(){
            $.ajax({
                method: 'post',
                url: '/api.php?tipo=deletar&codigo='+this.deletandoQuem.codigo,
                dataType: 'json',
                success: function (data) {
                    localStorage.setItem("users", JSON.stringify(data))
                },
                error: function (argument) {
                   
                }
            });
            this.excluindo = false
            const found = this.usuarios.find(e => e == this.deletandoQuem)
            if(found){
                const id = this.usuarios.indexOf(found)
                this.usuarios.splice(id, 1)
            }
        },
        deletar(people){
            this.excluindo = true
            this.deletandoQuem = people
        }
    }
})
