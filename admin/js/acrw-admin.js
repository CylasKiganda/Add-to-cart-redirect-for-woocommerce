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
    jQuery("#wc_settings_add_to_cart_redirect_acrw_url").select2({
      placeholder: "",
      templateResult: formatState,
      theme: "belo-acrw",
    });

    function formatState(state) {
      if (!state.id) {
        return state.text;
      }

      var text = state.text.split(",");

      var $state = jQuery(
        `<span>${text[0]}</span><span class="${text[1]}" style="color:#9e9e9e; float:right">${text[1]}</span>`
      );

      return $state;
    }
    $("#add_to_cart_simple_redirect").select2({
      placeholder: "",
      templateResult: formatState,
      theme: "belo-acrw",
    });
    $("#add_to_cart_variation_parent_redirect").select2({
      placeholder: "",
      templateResult: formatState,
      theme: "belo-acrw",
    });
    $("#add_to_cart_grouped_redirect").select2({
      placeholder: "",
      templateResult: formatState,
      theme: "belo-acrw",
    });
    $(document).ready(function () {
      if (
        $("#add_to_cart_variation_parent_redirect").length &&
        $("#add_to_cart_variation_parent_redirect")
          .closest(".show_if_variable")
          .attr("style") !== "display: none;"
      ) {
        var rendered_iput = $(
          ".add_to_cart_variation_parent_redirect_field .select2-container--belo-acrw .select2-selection__rendered"
        );
      } else {
        var rendered_iput = $(
          ".select2-container--belo-acrw .select2-selection__rendered"
        );
      }

      if (rendered_iput.text().indexOf(",") !== -1) {
        rendered_iput.text(rendered_iput.text().split(",")[0]);
      }
      rendered_iput.on("DOMSubtreeModified", function () {
        if ($(this).text().indexOf(",") !== -1) {
          $(this).text($(this).text().split(",")[0]);
        }
      });
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

              placeholder: "",
              templateResult: formatState,
              theme: "belo-acrw",
            });
            // input cleaning
            var rendered_iput_vars = $(this)
              .next(".woocommerce_variable_attributes ")
              .find(
                ".select2-container--belo-acrw .select2-selection__rendered"
              );
            if (rendered_iput_vars.text().indexOf(",") !== -1) {
              rendered_iput_vars.text(
                rendered_iput_vars
                  .text()
                  .replace(
                    $(
                      ".select2-container--belo-acrw .select2-selection__rendered span"
                    ).text(),
                    ""
                  )
                  .split(",")[0]
              );
            }
            rendered_iput_vars.on("DOMSubtreeModified", function () {
              if (rendered_iput_vars.text().indexOf(",") !== -1) {
                rendered_iput_vars.text(
                  rendered_iput_vars
                    .text()
                    .replace(
                      $(
                        ".select2-container--belo-acrw .select2-selection__rendered span"
                      ).text(),
                      ""
                    )
                    .split(",")[0]
                );
              }
            });
          }
        );
      });
    });

    /**
     * Select2 - focus on search field when opened and the select is not multiple.
     * For multiple select this is already handled by select2.
     */
    $(document).on("select2:open", function (e) {
      if (!e.target.multiple) {
        setTimeout(function () {
          document
            .querySelector(
              ".select2-container--belo-acrw .select2-search__field"
            )
            .focus();
        }, 50);
      }
    });
  });
})(jQuery);
