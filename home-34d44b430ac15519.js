(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[229],{8252:function(e){"use strict";e.exports=function e(t,i){if(t===i)return!0;if(t&&i&&"object"==typeof t&&"object"==typeof i){if(t.constructor!==i.constructor)return!1;var n,o,a;if(Array.isArray(t)){if((n=t.length)!=i.length)return!1;for(o=n;0!==o--;)if(!e(t[o],i[o]))return!1;return!0}if(t.constructor===RegExp)return t.source===i.source&&t.flags===i.flags;if(t.valueOf!==Object.prototype.valueOf)return t.valueOf()===i.valueOf();if(t.toString!==Object.prototype.toString)return t.toString()===i.toString();if((n=(a=Object.keys(t)).length)!==Object.keys(i).length)return!1;for(o=n;0!==o--;)if(!Object.prototype.hasOwnProperty.call(i,a[o]))return!1;for(o=n;0!==o--;){var r=a[o];if(("_owner"!==r||!t.$$typeof)&&!e(t[r],i[r]))return!1}return!0}return t!==t&&i!==i}},4309:function(e,t,i){(window.__NEXT_P=window.__NEXT_P||[]).push(["/home",function(){return i(4525)}])},4525:function(e,t,i){"use strict";i.r(t),i.d(t,{default:function(){return b}});var n=i(7568),o=i(4051),a=i.n(o),r=i(5893),s=i(9008),l=i.n(s),c=i(9813),m=i.n(c),_=i(214),p=i.n(_),u=i(7294),d=i(192),h=i(8252),f=i.n(h);const v="tsparticles";class g extends u.Component{constructor(e){super(e),this.state={init:!1,library:void 0}}destroy(){this.state.library&&(this.state.library.destroy(),this.setState({library:void 0}))}shouldComponentUpdate(e){return!f()(e,this.props)}componentDidUpdate(){this.refresh()}forceUpdate(){this.refresh().then((()=>{super.forceUpdate()}))}componentDidMount(){(async()=>{this.props.init&&await this.props.init(d.S6T),this.setState({init:!0},(async()=>{await this.loadParticles()}))})()}componentWillUnmount(){this.destroy()}render(){const{width:e,height:t,className:i,canvasClassName:n,id:o}=this.props;return u.createElement("div",{className:i,id:o},u.createElement("canvas",{className:n,style:Object.assign(Object.assign({},this.props.style),{width:e,height:t})}))}async refresh(){this.destroy(),await this.loadParticles()}async loadParticles(){var e,t,i;if(!this.state.init)return;const n=null!==(t=null!==(e=this.props.id)&&void 0!==e?e:g.defaultProps.id)&&void 0!==t?t:v,o=this.props.url?await d.S6T.loadJSON(n,this.props.url):await d.S6T.load(n,null!==(i=this.props.params)&&void 0!==i?i:this.props.options);await(async e=>{this.props.container&&(this.props.container.current=e),this.setState({library:e}),this.props.loaded&&await this.props.loaded(e)})(o)}}g.defaultProps={width:"100%",height:"100%",options:{},style:{},url:void 0,id:v};var y=g,x=i(338),w=i(1163),b=function(e){e.apps;var t=(0,w.useRouter)(),o=function(e,n,o){!function(e){e.preventDefault()}(o),function(e,t,n){var o=window.parent.document.getElementsByClassName(p()["main-frame"])[0].querySelector("iframe");"proxy"==e?o.src="/route?query="+encodeURIComponent(decodeURIComponent(t)):"redirect"==e?o.src=t:"home"==e?o.src="/home":"route"==e?(n.replace(t),"/home"==i.g.window.location.pathname&&i.g.window.parent.document.querySelector("iframe#frame").onload()):o.src=t}(e,n,t)},s=function(){var e=(0,n.Z)(a().mark((function e(t){return a().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,(0,x.R)(t);case 2:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),c=function(){},_=document.getElementById(m()["context-menu"]);window.addEventListener("contextmenu",(function(e){e.preventDefault(),_.style.top=e.clientY+"px",_.style.left=e.clientX+"px",_.classList.add(m().active)})),_.addEventListener("mouseover",(function(){return _.over=!0})),_.addEventListener("mouseout",(function(){return _.over=!1})),window.addEventListener("click",(function(){_.over||_.classList.remove(m().active)}));var u=function(){if(localStorage.getItem("ill@css")){window.style&&window.style.remove();var e=document.createElement("style");e.textContent=localStorage.getItem("ill@css"),document.head.appendChild(e);var t="custom";return document.querySelectorAll("*").forEach((function(e){e.setAttribute("data-theme",t)})),void(window.style=e)}if(localStorage.getItem("ill@theme")){t=localStorage.getItem("ill@theme");document.querySelectorAll("*").forEach((function(e){e.setAttribute("data-theme",t)}))}};return window.theme=u,window.onload=function(e){setTimeout((function(){localStorage.getItem("ill@title")?document.title=localStorage.getItem("ill@title"):document.title="Illusive",localStorage.getItem("ill@icon")?document.querySelector('link[rel="icon"]').href=localStorage.getItem("ill@icon"):document.querySelector('link[rel="icon"]').href="/favicon.ico"}),1),u()},u(),(0,r.jsxs)("div",{className:m().main,"data-theme":"classic",children:[(0,r.jsxs)(l(),{children:[(0,r.jsx)("title",{children:"Illusive | Frame Page"}),(0,r.jsx)("meta",{name:"description",content:"Illusive | Gateway to Evading Censorship"}),(0,r.jsx)("meta",{name:"theme-color",content:"#565656"}),(0,r.jsx)("link",{rel:"icon",href:"/favicon.ico"}),(0,r.jsx)("meta",{property:"og:image",content:"/favicon.ico"})]}),(0,r.jsxs)("main",{className:m().main,children:[(0,r.jsxs)("div",{id:m()["context-menu"],children:[(0,r.jsx)("div",{className:m().divider}),(0,r.jsxs)("div",{className:m().item,children:[(0,r.jsx)("i",{className:"".concat(m().uil," ").concat(m()["uil-redo"])}),"Refresh"]}),(0,r.jsxs)("div",{className:m().item,children:[(0,r.jsx)("i",{className:"uil uil-share"}),"Share"]}),(0,r.jsx)("div",{className:m().divider}),(0,r.jsxs)("div",{className:m().item,children:[(0,r.jsx)("i",{className:"uil uil-trash"}),"Delete"]}),(0,r.jsxs)("div",{className:m().item,children:[(0,r.jsx)("i",{className:"uil uil-setting"}),"Settings"]})]}),(0,r.jsx)(y,{id:"tsparticles",init:s,loaded:c,options:{fpsLimit:120,interactivity:{events:{resize:!0}},particles:{color:{value:"#ffff"},move:{direction:"right",enable:!0,outModes:{default:"out"},random:!1,speed:.673,straight:!1},number:{density:{enable:!0,area:800},value:48},opacity:{value:.6814501258678471,random:!0,anim:{enable:!0,speed:.24362316369040352,opacity_min:.03248308849205381,sync:!1}},shape:{type:"circle"},size:{anim:{enable:!0,speed:2.872463273808071,size_min:2.436231636904035,sync:!1},value:{min:2,max:3}}},detectRetina:!0}}),(0,r.jsx)(y,{id:"lightparticles",init:s,loaded:c,options:{fpsLimit:120,interactivity:{events:{resize:!0}},particles:{color:{value:"#222"},move:{direction:"right",enable:!0,outModes:{default:"out"},random:!1,speed:.673,straight:!1},number:{density:{enable:!0,area:800},value:48},opacity:{value:.6814501258678471,random:!0,anim:{enable:!0,speed:.24362316369040352,opacity_min:.03248308849205381,sync:!1}},shape:{type:"circle"},size:{anim:{enable:!0,speed:2.872463273808071,size_min:2.436231636904035,sync:!1},value:{min:2,max:3}}},detectRetina:!0}}),(0,r.jsxs)("div",{className:m()["main-se"],children:[(0,r.jsx)("img",{src:"/Illusive.png",className:m().img}),(0,r.jsxs)("div",{className:m()["main-box"],children:[(0,r.jsx)("a",{className:m()["box-icon"],onClick:function(e){return o("proxy","https://twitter.com/TitaniumNetDev",e)},children:(0,r.jsx)("img",{className:m().qlimg,src:"/img/home/twitter.png"})}),(0,r.jsx)("a",{className:m()["box-icon"],onClick:function(e){return o("proxy","https://discord.gg/unblock",e)},children:(0,r.jsx)("img",{className:m().qlimg,src:"/img/home/discord.png",style:{width:"25px",height:"25px"}})}),(0,r.jsx)("a",{className:m()["box-icon"],onClick:function(e){return o("route","/settings",e)},children:(0,r.jsx)("img",{className:m().qlimg,src:"/img/home/gear.png",style:{width:"25px",height:"25px"}})})]})]})]})]})}},214:function(e){e.exports={main:"Home_main__nLjiQ","flex-vis":"Home_flex-vis__I5OcQ","apps-frame":"Home_apps-frame__2BSOr","main-frame":"Home_main-frame__14iOn","apps-down":"Home_apps-down__g3KJM","apps-dropdown":"Home_apps-dropdown__qxkSU","apps-up":"Home_apps-up__Y8O0U","user-form":"Home_user-form__iofTX","form-submit-main":"Home_form-submit-main__9lRID",clock:"Home_clock__yrr_f","icon-ico":"Home_icon-ico__Gtfiw",apps:"Home_apps__yEQoc",an:"Home_an__BhFM6",app:"Home_app__dQwNI",dropdown:"Home_dropdown__q4Jzb",marking:"Home_marking__wvoYh","bottom-container":"Home_bottom-container___y3WC","bottom-left-menu":"Home_bottom-left-menu__h9ofF","bottom-right-menu":"Home_bottom-right-menu__BCAsU",separator:"Home_separator__Mmydx","context-menu":"Home_context-menu__Pn6UH",active:"Home_active__YzwIj",pop:"Home_pop__CY3_A",item:"Home_item__UrFES","arrow-right":"Home_arrow-right__JD53w","uil-angle-right":"Home_uil-angle-right__frOVp",divider:"Home_divider__c4Nl_","main-nav-icon":"Home_main-nav-icon__LXgiV",historyTab:"Home_historyTab__f2wQi",tabsslidein:"Home_tabsslidein__KOZRN",historyapps:"Home_historyapps__rOi69",historyapp:"Home_historyapp__K__AB",historyapptext:"Home_historyapptext__lmOsd","reload-btn":"Home_reload-btn__Lgi5A",fill:"Home_fill__vxIY4","star-btn":"Home_star-btn__yrwrV","open-tabs":"Home_open-tabs__LrOzt",fillS:"Home_fillS__546Qh",normalLink:"Home_normalLink__lkqVn",ani:"Home_ani__p6XNc",cl:"Home_cl__SVsDL"}},9813:function(e){e.exports={main:"Main_main__IbvWf","main-se":"Main_main-se__kpJ7J",qlimg:"Main_qlimg__fz_aF",img:"Main_img__TJHA_","main-box":"Main_main-box__JvRxT","context-menu":"Main_context-menu__T0i56",active:"Main_active__ehR3x",pop:"Main_pop__i8w1e",item:"Main_item__JARc6","arrow-right":"Main_arrow-right__lUChf","uil-angle-right":"Main_uil-angle-right__fPlOl",divider:"Main_divider__2ZE_r","bottom-left-menu":"Main_bottom-left-menu__17QuQ"}}},function(e){e.O(0,[128,774,888,179],(function(){return t=4309,e(e.s=t);var t}));var t=e.O();_N_E=t}]);