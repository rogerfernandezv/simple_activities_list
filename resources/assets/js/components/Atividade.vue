<style>
 /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
} 
</style>
<template>
    <div class="container">

        <div class="modal fade" 
                id="novaAtividade" 
                tabindex="-1" 
                role="dialog" 
                aria-labelledby="atividadeModalLabel" 
                aria-hidden="true"
                data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="atividadeModalLabel">Nova Atividade</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" @submit.prevent="addAtividade">
                            <p v-if="errors.length">
                                <b>Corrija os seguinte(s) erro(s):</b>

                                    <div class="alert alert-danger" v-for="error in errors" role="alert" >
                                        {{ error }}
                                    </div>

                            </p>
                            <input type="hidden" v-model="fields.id">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" 
                                        class="form-control" 
                                        v-model="fields.nome" 
                                        placeholder="Nome"
                                        required
                                        :readonly="isReadonly">
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" 
                                            v-model="fields.descricao" 
                                            rows="3"
                                            required
                                            :readonly="isReadonly">
                                            </textarea>
                            </div>
                            <div class="form-group">
                                Data Início:
                                <datepicker
                                    :language="ptBR"
                                    v-model="fields.dt_inicio"
                                    format="dd-MM-yyyy"
                                    input-class="form-control"
                                    required
                                    v-if="!isReadonly"
                                    >
                                </datepicker>
                                <input type="text" 
                                        :readonly="isReadonly"
                                        class="form-control"
                                        v-model="fields.dt_inicio"
                                        v-else>
                            </div>
                            <div class="form-group">
                                Data Fim:
                                <datepicker
                                    :language="ptBR"
                                    v-model="fields.dt_fim"
                                    format="dd-MM-yyyy"
                                    input-class="form-control"
                                    :required="isRequired"
                                    v-if="!isReadonly"
                                    >
                                </datepicker>
                                <input type="text" 
                                        :readonly="isReadonly"
                                        class="form-control"
                                        v-model="fields.dt_fim"
                                        v-else>
                            </div>
                            <div class="form-group">
                                Status
                                <select class="form-control form-control" 
                                        v-model="fields.status_id"
                                        :readonly="isReadonly"
                                        required>
                                      <option disabled value="">Escolha um Status</option>
                                      <option v-for="stat in status" :value="stat.id">{{stat.display_name}}</option>
                                </select>
                            </div>

                            Situação:<br>
                            <label class="switch">
                                <input type="checkbox" 
                                        v-model="fields.situacao"
                                        :disabled="isReadonly">
                                <span class="slider round"></span>
                            </label>
                            <br>
                            <button
                                type="submit"
                                class="btn btn-primary" 
                                align="left"
                                v-if="!isReadonly"
                                >
                            Cadastrar</button>
                            <span class="btn btn-secondary" v-on:click="closeModal">Close</span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div> <!-- fim modal content-->
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#novaAtividade">
                          Novo
                        </button>
                        <br><br>
                        <table class="table">
                            <thead>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Situação</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </thead>
                            <tbody>
                                <tr v-for="atividade in atividades">
                                    <td>{{atividade.nome}}</td>
                                    <td>{{atividade.descricao}}</td>
                                    <td>{{atividade.dt_inicio}}</td>
                                    <td>{{atividade.dt_fim}}</td>
                                    <td>{{atividade.situacao | normalize_situacao}}</td>
                                    <td>{{atividade.status_synonym.display_name}}</td>
                                    <td>
                                        <span v-on:click="editAtividade(atividade)">Editar</span>
                                        <span v-on:click="deleteAtividade(atividade.id)">Deletar</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import {ptBR, es} from 'vuejs-datepicker/dist/locale';

    export default {
        mounted() {
            console.log('Component mounted.');
        },

        components: {
            Datepicker,
            es
        },

        props: ['ptBR', 'es'],

        created: function(){
            this.getAtividades();
            this.getStatus();
        },

        filters: {
            normalize_situacao: function(value){
                if(value)
                    return 'Ativo';
                else
                    return 'Não ativo';
            }
        },

        data(){
            return {
                fields: {
                    'nome': '',
                    'descricao': '',
                    'dt_inicio': '',
                    'dt_fim': '',
                    'status_id': '',
                    'situacao': false,
                    'id': '',
                },
                isRequired: false,
                isReadonly: false,
                atividades: [],
                status: [],
                errors: [],
            }
        },

        computed: {
            status_id(){
                return this.fields.status_id;
            }
        },

        watch:{
            status_id() {
                /*if(this.status_id == 5)
                    this.isRequired = true;
                else
                    this.isRequired = false;*/
                this.isRequired = this.status_id == 5 ? true: false;
            }
        },

        methods:{
            getStatus: function(){
                var self = this;
                axios.get('/api/status')
                    .then(function(response){
                        //console.log(response.data);
                        self.status = response.data;
                    });
            },

            getAtividades: function(){
                var self = this;
                axios.get('/api/atividade')
                    .then(function(response){
                        //console.log(response.data);
                        self.atividades = response.data;
                    });
            },

            addAtividade: function(){
                this.errors = [];
                if(this.fields.nome.length > 255)
                    this.errors.push('Nome tem que ter no máximo 255 caracteres!');
                if(this.fields.descricao.length > 600)
                    this.errors.push('Descrição tem que ter no máximo 600 caracteres!');
                
                if(this.errors.length == 0)
                {
                    var self = this;
                    console.log('testando');
                    axios.post('/api/atividade', this.fields)
                        .then(function(response){
                            console.log(response.data);
                            //self.atividades = response.data;
                            self.getAtividades();
                            $('#novaAtividade').modal('hide');
                            self.clearFields();
                        });
                }
            },

            closeModal(){
                this.clearFields();
                $('#novaAtividade').modal('hide');
            },

            clearFields: function(){
                this.fields = {
                    'nome': '',
                    'descricao': '',
                    'dt_inicio': '',
                    'dt_fim': '',
                    'status_id': '',
                    'situacao': false,
                    'id': '',
                };
                this.isRequired = false;
                this.isReadonly = false;
                this.errors = [];
            },

            editAtividade: function(atividade){
                this.fields.nome = atividade.nome;
                this.fields.descricao = atividade.descricao;
                this.fields.dt_inicio = atividade.dt_inicio;
                this.fields.dt_fim = atividade.dt_fim;
                this.fields.status_id = atividade.status_id;
                this.fields.situacao = atividade.situacao;
                this.fields.id = atividade.id;

                if(this.fields.status_id == 5)
                    this.isReadonly = true;

                $('#novaAtividade').modal('show');
            },

            deleteAtividade: function(id){
                var self = this;
                axios.get('/atividade/' + id + '/delete')
                    .then(function(response){
                        self.clearFields();
                        self.getAtividades();
                        console.log(response.data);
                    });
            }

        }

    }
</script>
