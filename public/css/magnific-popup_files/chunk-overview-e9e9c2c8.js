System.register(["./chunk-vendor.js"],(function(){"use strict";var t,e,n;return{setters:[function(r){t=r.a,e=r.K,n=r.H}],execute:function(){t("tab-container-changed",".js-branches-tags-tabs",(async function(t){const r=t.detail.relatedTarget,o=t.currentTarget;if(!o)return;let i,s;for(const u of o.querySelectorAll("[data-controls-ref-menu-id]")){if(!(u instanceof e||u instanceof n))return;const t=u.getAttribute("data-controls-ref-menu-id"),o=r.id===t;u.hidden=!o,o?s=u:i||(i=u.input?u.input.value:"")}const a=s&&s.input;a&&(s&&void 0!==i&&(a.value=i),a.focus())})),t("click",".js-onboarding-popover-height",(function(t){const e=t.currentTarget,n=e.closest(".js-onboarding-popover");"true"===n.getAttribute("data-fullsize")?(n.setAttribute("data-fullsize","false"),e.style.transform="rotate(0deg)"):(n.setAttribute("data-fullsize","true"),e.style.transform="rotate(180deg)")})),t("click",".js-onboarding-list-all",(function(t){t.preventDefault(),document.querySelector(".js-task-list-container ul").hidden=!1,document.querySelector(".js-task-list-container h1").hidden=!1,document.querySelector(".js-onboarding-guidance").hidden=!0}))}}}));
//# sourceMappingURL=chunk-overview-889fcb49.js.map