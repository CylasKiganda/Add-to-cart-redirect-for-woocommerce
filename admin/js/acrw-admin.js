(function ($) {
  "use strict";

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  jQuery(document).ready(function ($) {
    jQuery("#wc_settings_add_to_cart_redirect_acrw_title").select2({
      allowClear: true,
      placeholder: "",
    });
    function formatState(state) {
      if (!state.id) {
        return state.text;
      }

      var text = state.text.split(",");
      var $state = jQuery(
        `<span>${text[0]}</span><span style="color:#9e9e9e; float:right">${text[1]}</span>`
      );

      return $state;
    }
    $("#add_to_cart_simple_redirect").select2({
      allowClear: true,
      placeholder: "",
      templateResult: formatState,
      theme: "belo-acrw",
    });
    $("#select2-add_to_cart_simple_redirect-container").text(
      $("#select2-add_to_cart_simple_redirect-container")
        .text()
        .replace(
          $("#select2-add_to_cart_simple_redirect-container span").text(),
          ""
        )
        .split(",")[0]
    );
    $("#select2-add_to_cart_simple_redirect-container").on(
      "DOMSubtreeModified",
      function () {
        $(this).text(
          $(this)
            .text()
            .replace(
              $("#select2-add_to_cart_simple_redirect-container span").text(),
              ""
            )
            .split(",")[0]
        );
      }
    );

    $("#add_to_cart_variation_parent_redirect").select2({
      allowClear: true,
      placeholder: "",
    });
    $("#add_to_cart_grouped_redirect").select2({
      allowClear: true,
      placeholder: "",
    });

    $("#woocommerce-product-data").on("woocommerce_variations_loaded", () => {
      $(document).ajaxComplete(() => {
        $("#variable_product_options_inner").on(
          "click",
          ".woocommerce_variation.closed h3",
          function (e) {
            // get current ddl
            let ddl = $("select.belo_variation_select", $(this).parent());

            // already a select2?
            if (ddl.hasClass("select2-hidden-accessible")) return; // get out...

            // select2-ify dropdown
            ddl.select2({
              width: "400px",
              allowClear: true,
              placeholder: "",
            });
          }
        );
      });
    });
    $(document).on("select2:open", () => {
      document
        .querySelector(
          ".select2-container--belo-acrw.select2-container--open .select2-search__field"
        )
        .focus();
    });
  });
})(jQuery);
