<template>
  <layout>
    <!-- Modal -->

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4" align="center">
        <h4>Alterar Eletrodoméstico</h4>
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
          <h4><span style="font-weight: bold">Registro</span></h4>
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
                >
                  <option selected>{{ form.marca }}</option>
                  <option
                    v-for="marca in this.form.marcas"
                    :key="marca.id_marca"
                    :value="marca.nome"
                  >
                    {{ marca.nome }}
                  </option>
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
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success align-btn-add">
                Atualizar
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
        marcas: [],
        nome_eletro: null,
        descricao: null,
        tensao: null,
        marca: null,
        route_back: window.location.listEletros
      },
    };
  },

  created() {
    axios.get("/api/marcas/listar").then((response) => {
      this.form.marcas = response.data;
    });

    axios
      .get("/api/eletrodomesticos/visualizar/" + this.id_eletro)
      .then((response) => {
        this.form.eletros = response.data;
        (this.form.id = this.form.eletros[0]["id_eletro"]),
          (this.form.nome_eletro = this.form.eletros[0]["nome_eletro"]),
          (this.form.descricao = this.form.eletros[0]["descricao"]);
        this.form.tensao = this.form.eletros[0]["tensao"];
        this.form.marca = this.form.eletros[0]["marca"];

        console.log(this.form.eletros);
      });
  },

  methods: {
    sendForm() {
      axios.post("/api/eletrodomesticos/atualizar", this.form).then(
        function (res) {
          if (res.data["success"]) {
            
            bootbox.alert({
              centerVertical: true,
              backdrop: true,
              closeButton: false,
              size: "large",
              title:
                "<img src='https://i0.wp.com/www.roteirospe.com/wp-content/uploads/2017/02/SEU-LOGO-AQUI-300x81-1-300x81-1.png?ssl=1'>",
              message:
                "<i class='fas fa-check-circle' style='color:green'></i>&nbsp&nbsp" +
                "<span style='font-weight:bold; position: relative; top: 5px;'>" +
                res.data["success"] +
                "</span>",
            });

            window.location.href = "/eletrodomesticos/listar"  


            $("#formCadEletro").each(function () {
              this.reset();
              $("#inputMarca").empty();
            });
          } else {
            this.form.errors = res.data;
            console.log(res.data);
          }
        }.bind(this)
      );
    },
  },
};
</script>