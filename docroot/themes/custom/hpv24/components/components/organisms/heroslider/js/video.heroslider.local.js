!function(e,o){o.behaviors.varbaseHeroSliderLocalVideo={attach(o){e(window).on("load",(function(){const t=e(".js-varbase-heroslider",o);if(t.on("slide.bs.carousel",(function(c){const i=e(this).find(".carousel-item.active"),r=e(this).find(".carousel-item:not(.active)"),l=i.find(".varbase-video-player video",o),d=r.find(".varbase-video-player video",o);if(l.length>0&&l.get(0).pause(),d.length>0){const e=d.get(0);let o;e.muted=!0,e.onpause=a,e.onended=n,e.onplay=s,o=e.play(),o&&0===Object.keys(o).length&&o.constructor===Object&&o.then((o=>{e.pause()})).catch((e=>{}))}else t.carousel("cycle")})),e("js-varbase-heroslider",o).each((function(){const a=e(this).find(".carousel-item.active").find(".varbase-video-player video",o);if(a.length>0){t.carousel("pause");const e=a.get(0);let o;e.muted=!0,o=e.play(),o&&0===Object.keys(o).length&&o.constructor===Object&&o.then((o=>{e.pause()})).catch((e=>{})),a.on("ended",(function(){t.carousel("cycle")}))}})),e(".js-varbase-heroslider",o).each((function(){const t=e(this).find(".carousel-item").find(".varbase-video-player video",o);if(t.length>0){const e=t.get(0);let o;e.muted=!0,e.loop=!0,o=e.play(),o&&0===Object.keys(o).length&&o.constructor===Object&&o.then((o=>{e.pause()})).catch((e=>{}))}})),e("js-varbase-heroslider .varbase-video-player video",o).length>0){const t=e("js-varbase-heroslider .varbase-video-player video",o).get(0);t.onpause=a,t.onended=n,t.onplay=s}function a(){t.carousel("next")}function n(){t.carousel("cycle")}function s(){t.carousel("pause")}}))}}}(jQuery,Drupal);