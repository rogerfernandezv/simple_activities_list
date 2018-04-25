<template>
    <div class="container">

        <div class="modal fade" id="novaAtividade" tabindex="-1" role="dialog" aria-labelledby="atividadeModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="atividadeModalLabel">Nova Atividade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" name="descricao" id="descricao" rows="3"></textarea>
                    </div>
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control" name="status">
                            <option>Status</option>
                        </select>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="situacao" name="situacao">
                        <label class="form-check-label" for="exampleCheck1">Ativo</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
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

                        <table class="table">
                            <thead>
                                <th>teste1</th>
                                <th>teste2</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>dado1</td>
                                    <td>dado11</td>
                                </tr>
                                <tr>
                                    <td>dado2</td>
                                    <td>dado22</td>
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
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
