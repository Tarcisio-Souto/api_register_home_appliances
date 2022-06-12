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
          id="formAddMulta"
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
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
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
                  <option selected>Selecione a marca</option>
                  <option
                    v-for="marca in marcas"
                    :key="marca.id_marca"
                    :value="marca.id_marca"
                  >
                    {{ marca.nome }}
                  </option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="inputDescricao">Descrição</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDescricao">Descrição</label>
                    <textarea
                      class="form-control"
                      id="inputDescricao"
                      rows="3"
                      v-model="form.descricao"
                    ></textarea>
                  </div>
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
              </div>
            </div>

          </div>
          <div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success btnCadastrar">
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
  props: {
    errors: Object,
    marcas: Array,
  },
  data: () => {
    return {
      form: {
        nome: null,
        fk_marca: null,
        descricao: null,
        tensao: null,
      },
    };
  },
  methods: {
    sendForm() {

      this.$inertia.post("eletrodomesticos/registrar", this.form, {
        forceFormData: true,
        preserveScroll: false,
        _token: this.$page.props.csrf_token,
        preserveState: false,
        onSuccess: () => {
          bootbox.alert({
            centerVertical: true,
            backdrop: true,
            closeButton: false,
            size: "large",
            title:
              "<img src='https://i0.wp.com/www.roteirospe.com/wp-content/uploads/2017/02/SEU-LOGO-AQUI-300x81-1-300x81-1.png?ssl=1'>",
            message:
              "<i class='fas fa-check-circle' style='color:green'></i>&nbsp&nbsp" +
              "<span style='font-weight:bold; position: relative; top: 5px;'>Multa registrada com sucesso!</span>",
          });

          $("#formAddMulta").reset();
        },

      });
    },
  },
};
</script>