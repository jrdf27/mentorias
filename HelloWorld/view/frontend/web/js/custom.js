define([
    "jquery",
    "jquery/ui"
    ], function($){
    "use strict";
    
    function main(config, element) {
    var $elementvar = $(element);
    var AjaxUrlcall = config.AjaxUrl;
    var CurrentProduct = config.CurrentProduct;
    
    $(document).ready(function(){
    setTimeout(function(){
    $.ajax({
    context: '#ajax-response-id',
    url: AjaxUrlcall,
    type: "POST",
    data: {currentproduct:CurrentProduct},
    }).done(function (data) {
    $('#ajax-response-id').html(data.output);
    return true;
    });
    },1000);
    });
    };
    return main;
    });