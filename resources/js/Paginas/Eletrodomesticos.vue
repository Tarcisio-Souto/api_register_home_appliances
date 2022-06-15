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

      <input type="text" v-model="form.search" />
      <br /><br />

      <div class="table-responsive-lg" id="div_table">
        <table
          id="tbl-list-eletros"
          class="table table-striped table-bordered table-hover"
          style="width: 100%"
        >
          <thead>
            <tr>
              <th @click="sort('nome_eletro')">Produto</th>
              <th @click="sort('marca')">Marca</th>
              <th @click="sort('tensao')">Tensão</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="eletro in sortedEletros"
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
        <p>
          <button @click="prevPage">Anterior</button>
          <button @click="nextPage">Próximo</button>
        </p>
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
        currentSort: "produto",
        currentSortDir: "asc",
        pageSize: 3,
        currentPage: 1,
        search: "",
      },
    };
  },

  created() {
    axios.get("/api/eletrodomesticos/listar").then((response) => {
      this.form.eletros = response.data;
    });
  },

  methods: {
    nextPage: function () {
      if (this.form.currentPage * this.form.pageSize < this.form.eletros.length)
        this.form.currentPage++;
    },
    prevPage: function () {
      if (this.form.currentPage > 1) this.form.currentPage--;
    },

    sort: function (s) {
      //if s == current sort, reverse
      if (s === this.form.currentSort) {
        this.form.currentSortDir =
          this.form.currentSortDir === "asc" ? "desc" : "asc";
      }
      this.form.currentSort = s;
    },

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

                  $("#div_table").load(location.href + "#div_table");
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

  computed: {
    sortedEletros: function () {
      return this.form.eletros
        .sort((a, b) => {
          let modifier = 1;
          if (this.form.currentSortDir === "asc") modifier = -1;
          if (a[this.form.currentSort] < b[this.form.currentSort]) {
            return -1 * modifier;
          }

          if (a[this.form.currentSort] > b[this.form.currentSort]) {
            return 1 * modifier;
          }

          return 0;
        })
        .filter((row, index) => {
          let start = (this.form.currentPage - 1) * this.form.pageSize;
          let end = this.form.currentPage * this.form.pageSize;
          if (index >= start && index < end) return true;
        })
        .filter((eletro) => {
          return (
            eletro.nome_eletro
              .toLowerCase()
              .indexOf(this.form.search.toLowerCase()) > -1
          );
        });
    },

  },
};
</script>