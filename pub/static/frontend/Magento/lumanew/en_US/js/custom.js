define([
  "jquery",
  "whatever lib you wanna use..."
], 
function($) {
  "use strict";

     $("#newsletter-validate-detail").submit(function(e){
                alert('This is just a test');
                e.preventDefault(e);
            });
    return;
});