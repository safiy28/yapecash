/*$.fn.myRadio = function (option) {
  var itemTamplate = `
    <input type="radio" value="{%value%}" id="{%id%}" name="{%name%}">
    <label for="{%id%}">{%identity%}</label>
  `;

  var items = $(this).children();

  var randerItems = function () {
      $(items).each(function (t) {
        var op_name = $(this).data('name');
        var op_id = option.id_prefix+t;
        var op_value = $(this).data('val');
        var innerData = $(this).html();
        var temp = itemTamplate;
        $(this).html(
            temp.replace("{%id%}",op_id)
                .replace("{%id%}",op_id)
                .replace("{%value%}",op_value)
                .replace("{%identity%}",innerData)
                .replace("{%name%}",op_name)
        );
      });
  };

  randerItems();
};

$('#radio-option').myRadio({
    id_prefix : "operator"
});
$('#radio-option2').myRadio({
   id_prefix : "molla"
});*/
