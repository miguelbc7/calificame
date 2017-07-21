var rangeValues =
    {   
      "0": "Muy Malo",
      "1": "Malo",
      "2": "Regular",
      "3": "Bueno",
      "4": "Excelente"
    };


$(function () {

  // on page load, set the text of the label based the value of the range
  $('#rangeText').text(rangeValues[$('#rangeInput').val()]);

  // setup an event handler to set the text when the range value is dragged (see event for input) or changed (see event for change)
  $('#rangeInput').on('input change', function () {
    $('#rangeText').text(rangeValues[$(this).val()]);
  });

});



var rangeValues2 =
    {   
      "0": "Muy Malo",
      "1": "Malo",
      "2": "Regular",
      "3": "Bueno",
      "4": "Excelente"
    };


$(function () {

  // on page load, set the text of the label based the value of the range
  $('#rangeText2').text(rangeValues2[$('#rangeInput2').val()]);

  // setup an event handler to set the text when the range value is dragged (see event for input) or changed (see event for change)
  $('#rangeInput2').on('input change', function () {
    $('#rangeText2').text(rangeValues2[$(this).val()]);
  });

});

var rangeValues3 =
    {   
      "0": "Muy Malo",
      "1": "Malo",
      "2": "Regular",
      "3": "Bueno",
      "4": "Excelente"
    };


$(function () {

  // on page load, set the text of the label based the value of the range
  $('#rangeText3').text(rangeValues3[$('#rangeInput3').val()]);

  // setup an event handler to set the text when the range value is dragged (see event for input) or changed (see event for change)
  $('#rangeInput3').on('input change', function () {
    $('#rangeText3').text(rangeValues3[$(this).val()]);
  });

});

var rangeValues4 =
    {   
      "0": "Muy Malo",
      "1": "Malo",
      "2": "Regular",
      "3": "Bueno",
      "4": "Excelente"
    };


$(function () {

  // on page load, set the text of the label based the value of the range
  $('#rangeText4').text(rangeValues4[$('#rangeInput4').val()]);

  // setup an event handler to set the text when the range value is dragged (see event for input) or changed (see event for change)
  $('#rangeInput4').on('input change', function () {
    $('#rangeText4').text(rangeValues4[$(this).val()]);
  });

});