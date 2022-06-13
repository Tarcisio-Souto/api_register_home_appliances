<template onload="sidepanel()">
  <main>
    <header>
      <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <nav
          class="navbar navbar-inverse fixed-top"
          id="sidebar-wrapper"
          role="navigation"
        >
          <ul class="sidebar-nav">
            <div class="sidebar-header">
              <div class="sidebar-brand">
                <a href="#">
                  <img
                    src="https://i0.wp.com/www.roteirospe.com/wp-content/uploads/2017/02/SEU-LOGO-AQUI-300x81-1-300x81-1.png?ssl=1"
                    alt="VHLogo"
                    width="150px"
                  />
                </a>
              </div>
            </div>
            <li><Link href="/"><i class="fas fa-home icons-menu"></i>Início </Link></li>
            <li class="dropdown">
              <a href="" class="dropdown-toggle" data-toggle="dropdown"
                ><i class="fas fa-solid fa-blender-phone icons-menu"></i>Eletrodomésticos</a
              >
              <ul class="dropdown-menu animated fadeInLeft" role="menu">
                <!--<div class="dropdown-header">Ferramentas</div>-->
                <li><Link href="/eletrodomesticos/listar"><i class="fas fa-solid fa-list icons-menu"></i>Listar</Link></li>
                <li><Link href="/eletrodomesticos/novo"><i class="fas fa-user-plus icons-menu"></i>Cadastrar</Link></li>
              </ul>
            </li>
          </ul>
        </nav>

        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <button
            type="button"
            class="hamburger animated fadeInLeft is-closed"
            data-toggle="offcanvas"
          >
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
          </button>
          <div class="container">
            <article>
              <slot />
            </article>
          </div>
        </div>
        <!-- /#page-content-wrapper -->
      </div>
      <!-- /#wrapper -->
    </header>
  </main>
</template>

<script>

import { Link } from "@inertiajs/inertia-vue";

export default {
  components: {
    Link,
  },
  mounted() {
    $(function () {
      var trigger = $(".hamburger"),
        overlay = $(".overlay"),
        isClosed = false;

      trigger.click(function () {
        hamburger_cross();
      });

      function hamburger_cross() {
        if (isClosed == true) {
          overlay.hide();
          trigger.removeClass("is-open");
          trigger.addClass("is-closed");
          isClosed = false;
        } else {
          overlay.show();
          trigger.removeClass("is-closed");
          trigger.addClass("is-open");
          isClosed = true;
        }
      }

      $('[data-toggle="offcanvas"]').click(function () {
        $("#wrapper").toggleClass("toggled");
      });
    });
  }
  
  
};
</script>
