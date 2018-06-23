const convert = {
  makePayload: function(baseCurrency) {
    const data = {
      action: "convert_prices",
      base_currency: baseCurrency
    };
    return data;
  },
  run: function(baseCurrency) {
    jQuery.post(ajaxurl, this.makePayload(baseCurrency), function(response) {
      const parsedResponse = JSON.parse(
        response.substring(0, response.length - 1)
      );
      console.log(parsedResponse);
      jQuery("#convert-results").append(parsedResponse.html);
    });
  }
};

jQuery(document).ready(function() {
  jQuery("#convert-run").click(function(event) {
    event.preventDefault();
    const baseCurrency = jQuery("#currency-code").val();
    convert.run(baseCurrency);
  });
});
