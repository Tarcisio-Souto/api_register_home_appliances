<template>
  <layout>
    <!-- Modal -->

    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4" align="center">
        <h4>Cadastrar Eletrodomésticos</h4>
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
          <h4><span style="font-weight: bold">Registrar</span></h4>
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
                  v-model="form.nome"
                  name="txtNome"
                />
              </div>
              <div v-for="erro in this.form.errors" :key="erro">
                <div v-if="erro['nome']">
                  <span v-if="erro != ''" class="errors-label-notification">
                    <i class="fas fa-exclamation-circle"></i>{{ erro["nome"] }}
                  </span>
                </div>
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
                  v-model="form.fk_marca"
                  name="txtMarca"
                >
                  <option
                    v-for="marca in this.form.marcas"
                    :key="marca.id_marca"
                    :value="marca.id_marca"
                  >
                    {{ marca.nome }}
                  </option>
                </select>
              </div>
              <div v-for="erro in this.form.errors" :key="erro">
                <div v-if="erro['marca']">
                  <span v-if="erro != ''" class="errors-label-notification">
                    <i class="fas fa-exclamation-circle"></i>{{ erro["marca"] }}
                  </span>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <label for="inputTensao">Tensão</label>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="inputTensao1"
                      value="m"
                      v-model="form.tensao"
                    />
                    <label class="form-check-label" for="exampleRadios1">
                      110v
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      id="inputTensao2"
                      v-model="form.tensao"
                      value="110v"
                    />
                    <label class="form-check-label" for="exampleRadios2">
                      220v
                    </label>
                  </div>
                </div>
                <div v-for="erro in this.form.errors" :key="erro">
                  <div v-if="erro['tensao']">
                    <span v-if="erro != ''" class="errors-label-notification">
                      <i class="fas fa-exclamation-circle"></i
                      >{{ erro["tensao"] }}
                    </span>
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
              <div v-for="erro in this.form.errors" :key="erro">
                <div v-if="erro['descricao']">
                  <span v-if="erro != ''" class="errors-label-notification">
                    <i class="fas fa-exclamation-circle"></i
                    >{{ erro["descricao"] }}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success align-btn-add">
                Cadastrar
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

  data() {
    return {
      form: {
        nome: null,
        fk_marca: null,
        descricao: null,
        tensao: null,
        marcas: [],
        errors: [],
      },
    };
  },

  created() {
    axios.get("/api/marcas/listar").then((response) => {
      this.form.marcas = response.data;
    });
  },

  methods: {
    sendForm() {
      axios.post("/api/eletrodomesticos/registrar", this.form).then(
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