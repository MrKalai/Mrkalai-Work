!function(t){function e(t){var e="";"lowerLetter"==t?e="abcdefghijklmnopqrstuvwxyz0123456789":"upperLetter"==t?e="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789":"symbol"==t&&(e=",.?/\\(^)![]{}*&^%$#'\"");var a=e.split("");return a[Math.floor(Math.random()*a.length)]}t.fn.shuffleLetters=function(a){var r=t.extend({step:8,fps:25,text:"",callback:function(){}},a);return this.each(function(){var a=t(this),n="";if(a.data("animated"))return!0;a.data("animated",!0),n=r.text?r.text.split(""):a.text().split("");for(var i=[],s=[],o=0;o<n.length;o++){var l=n[o];" "!=l?(/[a-z]/.test(l)?i[o]="lowerLetter":/[A-Z]/.test(l)?i[o]="upperLetter":i[o]="symbol",s.push(o)):i[o]="space"}a.html(""),function t(o){var l,f=s.length,u=n.slice(0);if(o>f)return a.data("animated",!1),void r.callback(a);for(l=Math.max(o,0);l<f;l++)l<o+r.step?u[s[l]]=e(i[s[l]]):u[s[l]]="";a.text(u.join("")),setTimeout(function(){t(o+1)},1e3/r.fps)}(-r.step)})}}(jQuery);