<template>
  <layout>
    <div class="container">
      <div class="row btn-actions">
        <div class="col-md-12">
          <Link :href="'/eletrodomesticos/novo'" class="btn btn-primary btnNovo"
            >Novo</Link
          >
        </div>
      </div>

      <div class="table-responsive-lg" id="div_table">
        <table
          id="tbl-list-eletros"
          class="table table-striped table-bordered table-hover"
          style="width: 100%"
        >
          <thead>
            <tr>
              <th>Produto</th>
              <th>Marca</th>
              <th>Tensão</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="eletro in this.form.eletros"
              :key="eletro.eletro_id"
              :value="eletro.eletro_id"
            >
              <td>{{ eletro.nome_eletro }}</td>
              <td>{{ eletro.marca }}</td>
              <td>{{ eletro.tensao }}</td>
              <td align="center">
                <Link :href="'/eletrodomesticos/visualizar/' + eletro.id_eletro"
                  ><i class="fas fa-eye"></i
                ></Link>
                <Link :href="'/eletrodomesticos/editar/' + eletro.id_eletro"
                  ><i class="fas fa-edit"></i
                ></Link>
                <span
                  ><i
                    class="fas fa-trash-alt"
                    @click="sendForm(eletro.id_eletro)"
                  ></i
                ></span>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <th>Produto</th>
              <th>Marca</th>
              <th>Tensão</th>
              <th>Ações</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "../Layout.vue";
import { Link } from "@inertiajs/inertia-vue";

export default {
  components: {
    Link,
    Layout,
  },

  data: () => {
    return {
      form: {
        id: null,
        eletros: [],
        aux_eletros: []
      },
    };
  },

  created() {
    axios.get("/api/eletrodomesticos/listar").then((response) => {
      this.form.eletros = response.data;
    });
  },

  methods: {
    sendForm(id) {
      var v = this;

      bootbox.confirm({
        centerVertical: true,
        backdrop: true,
        closeButton: false,
        size: "large",
        title:
          "<img src='https://i0.wp.com/www.roteirospe.com/wp-content/uploads/2017/02/SEU-LOGO-AQUI-300x81-1-300x81-1.png?ssl=1'>",
        message:
          "<i class='fas fa-exclamation-circle' style='color:red'></i></i>&nbsp&nbsp" +
          "<span style='font-weight:bold; position: relative; top: 5px;'>Deletar produto?</span>",
        buttons: {
          cancel: {
            label: '<i class="fa fa-times"></i> Não',
          },
          confirm: {
            className: "btn-danger",
            label: '<i class="fa fa-check"></i> Sim',
          },
        },
        callback: function (result) {
          if (result == true) {
            axios.post("/api/eletrodomesticos/deletar/" + id).then(
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

                  $('#div_table').load(location.href + "#div_table")

                } else {
                  this.form.errors = res.data;
                  console.log(res.data);
                }
              }.bind(this)
            );
          }
        },
      });
    },
  },
  mounted() {
    $(document).ready(function () {});
  },
};
</script>