<template>
  <layout>
    <!-- Modal -->

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4" align="center">
        <h4>Visualizar Eletrodoméstico</h4>
      </div>
      <div class="col-md-4"></div>
    </div>

    <hr />
    <br />
    <div class="row">
      <div class="col-md-12">
        <form
          @submit.prevent="sendForm"
          enctype="multipart/form-data"
          id="formCadEletro"
        >
          <h4><span style="font-weight: bold">Visualizar Cadastro</span></h4>
          <br />

          <div class="row">
            <div class="col-md-4">
              <label for="inputNome">Nome</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-calendar-alt"></i>
                  </div>
                </div>
                <input
                  key=""
                  type="text"
                  id="inputNome"
                  class="form-control"
                  v-model="form.nome_eletro"
                  name="txtNome"
                  disabled
                />
              </div>
            </div>

            <div class="col-md-4">
              <label for="inputMarca">Marca</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-building"></i>
                  </div>
                </div>
                <select
                  id="inputMarca"
                  class="form-control"
                  v-model="form.marca"
                  name="txtMarca"
                  disabled
                >
                  <option>{{ form.marca }}</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <label for="inputTensao">Tensão</label>
              <div class="row">
                <div class="col-md-12">
                  <div
                    class="form-check form-check-inline"
                    v-if="form.tensao == '110v'"
                  >
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="inputTensao1"
                      value="110v"
                      checked
                      disabled
                    />
                    <label class="form-check-label" for="exampleRadios1">
                      110v
                    </label>
                  </div>
                  <div class="form-check form-check-inline" v-else>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="inputTensao2"
                      value="220v"
                      disabled
                    />
                    <label class="form-check-label" for="exampleRadios2">
                      220v
                    </label>
                  </div>

                  <div
                    class="form-check form-check-inline"
                    v-if="form.tensao == '220v'"
                  >
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="inputTensao1"
                      value="220v"
                      checked
                      disabled
                    />
                    <label class="form-check-label" for="exampleRadios1">
                      220v
                    </label>
                  </div>
                  <div class="form-check form-check-inline" v-else>
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="inputTensao2"
                      value="110v"
                      disabled
                    />
                    <label class="form-check-label" for="exampleRadios2">
                      110v
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br /><br />

          <div class="row">
            <div class="col-md-8">
              <label for="inputDescricao">Descrição</label>
              <div class="input-group">
                <div class="input-group-prepend"></div>
                <div class="form-group">
                  <textarea
                    class="form-control"
                    id="inputDescricao"
                    rows="3"
                    cols="100"
                    v-model="form.descricao"
                    disabled
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning align-btn-add">
                Alterar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- <br> temporário -->

    <br /><br /><br /><br /><br />
    <br /><br /><br /><br /><br />
    <br /><br /><br /><br /><br />
  </layout>
</template>

<script>
import Layout from "../Layout.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    Layout,
  },

  props: {
    id_eletro: String,
  },

  data() {
    return {
      form: {
        id: null,
        eletros: [],
        nome_eletro: null,
        descricao: null,
        tensao: null,
        marca: null,
      },
    };
  },

  created() {
    axios
      .get("/api/eletrodomesticos/visualizar/" + this.id_eletro)
      .then((response) => {
        this.form.eletros = response.data;
        (this.form.nome_eletro = this.form.eletros[0]["nome_eletro"]),
          (this.form.descricao = this.form.eletros[0]["descricao"]);
        this.form.tensao = this.form.eletros[0]["tensao"];
        this.form.marca = this.form.eletros[0]["marca"];

        console.log(this.form.eletros);
      });
  },

  methods: {
    sendForm() {
      this.$inertia.get("/eletrodomesticos/editar/" + this.id_eletro);
    },
  },
};
</script>