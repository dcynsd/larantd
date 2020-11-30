(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-dd367b50"],{"116a":function(e,t,r){"use strict";r.r(t);var a=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("a-modal",{attrs:{title:(e.isEdit?"编辑":"新增")+"菜单",width:1e3,visible:e.visible,"confirm-loading":e.loading},on:{ok:function(){e.$emit("ok")},cancel:function(){e.$emit("cancel")}}},[r("a-spin",{attrs:{spinning:e.loading}},[r("a-form",e._b({attrs:{form:e.form}},"a-form",e.formLayout,!1),[r("a-form-item",{directives:[{name:"show",rawName:"v-show",value:e.isEdit,expression:"isEdit"}],attrs:{label:"主键ID"}},[r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["id",{initialValue:0}],expression:"['id', { initialValue: 0 }]"}],attrs:{disabled:""}})],1),r("a-form-item",{attrs:{label:"父级菜单"}},[r("a-select",{directives:[{name:"decorator",rawName:"v-decorator",value:["parent_id",{rules:[{required:!0,message:"请选择父级菜单"}]}],expression:"['parent_id', {rules: [{required: true, message: '请选择父级菜单'}]}]"}],attrs:{"option-filter-prop":"children","show-search":!0,options:e.treeData,placeholder:"请选择父级菜单"}})],1),r("a-form-item",{attrs:{label:"菜单标识"}},[r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["name",{rules:[{required:!0,min:1,message:"请输入至少一个字符的菜单标识！"}]}],expression:"['name', {rules: [{required: true, min: 1, message: '请输入至少一个字符的菜单标识！'}]}]"}],attrs:{placeholder:"菜单唯一标识"}})],1),r("a-form-item",{attrs:{label:"菜单标题"}},[r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["title",{rules:[{required:!0,min:1,message:"请输入至少一个字符的菜单标题！"}]}],expression:"['title', {rules: [{required: true, min: 1, message: '请输入至少一个字符的菜单标题！'}]}]"}],attrs:{placeholder:"用作显示左侧菜单标题"}})],1),r("a-form-item",{attrs:{label:"组件名称"}},[r("a-select",{directives:[{name:"decorator",rawName:"v-decorator",value:["component",{rules:[{required:!0,message:"请选择组件名称"}]}],expression:"['component', {rules: [{required: true, message: '请选择组件名称'}]}]"}],attrs:{placeholder:"请选择组件名称",options:e.componentKeys}})],1),r("a-form-item",[r("span",{attrs:{slot:"label"},slot:"label"},[e._v(" 重定向地址 "),r("a-tooltip",{attrs:{title:"用作顶级菜单，点击面包屑跳转地址"}},[r("a-icon",{attrs:{type:"question-circle-o"}})],1)],1),r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["redirect"],expression:"['redirect']"}],attrs:{placeholder:"例如：/dashboard/workplace"}})],1),r("a-form-item",[r("span",{attrs:{slot:"label"},slot:"label"},[e._v(" 路由PATH "),r("a-tooltip",{attrs:{title:"地址栏会显示该地址"}},[r("a-icon",{attrs:{type:"question-circle-o"}})],1)],1),r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["path"],expression:"['path']"}],attrs:{placeholder:"例如：/dashboard/analysis"}})],1),r("a-form-item",{attrs:{label:"图标"}},[r("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["icon"],expression:"['icon']"}]}),r("icon-selector",{on:{change:e.handleIconChange},model:{value:e.currentSelectedIcon,callback:function(t){e.currentSelectedIcon=t},expression:"currentSelectedIcon"}})],1),r("a-form-item",{attrs:{label:"排序"}},[r("a-input-number",{directives:[{name:"decorator",rawName:"v-decorator",value:["order",{initialValue:0}],expression:"['order', {initialValue: 0}]"}],attrs:{min:0,max:99999999}})],1),r("a-form-item",{attrs:{label:"是否显示"}},[r("a-switch",{directives:[{name:"decorator",rawName:"v-decorator",value:["is_show",{valuePropName:"checked"}],expression:"['is_show', { valuePropName: 'checked' }]"}],attrs:{"checked-children":"是","un-checked-children":"否"}})],1),r("a-form-item",{attrs:{label:"角色"}},[r("a-select",{directives:[{name:"decorator",rawName:"v-decorator",value:["roles"],expression:"['roles']"}],attrs:{mode:"multiple",placeholder:"请选择角色",options:e.roleData}})],1),r("a-form-item",{attrs:{label:"权限"}},[r("a-transfer",{directives:[{name:"decorator",rawName:"v-decorator",value:["permissions"],expression:"['permissions']"}],attrs:{titles:["待选","已选"],"data-source":e.permissionData,"target-keys":e.targetKeys,"show-search":"",render:function(e){return e.title}},on:{change:e.handleChange}})],1)],1)],1)],1)},n=[],o=(r("4160"),r("d81d"),r("b0c0"),r("d3b7"),r("25f0"),r("159b"),r("96cf"),r("1da1")),i=r("88bc"),s=r.n(i),c=r("13bb"),l=r("aba1"),d=r("8da9"),u=r("aa0f"),m=r("2ef0e"),p=r.n(m),f=["id","parent_id","order","name","title","component","icon","redirect","path","is_show","roles","permissions"],h=new l["a"]({fields:f}),v={components:{IconSelector:c["a"]},mixins:[h],data:function(){return{currentSelectedIcon:"",permissionData:[],roleData:[],treeData:[],targetKeys:[],componentKeys:[]}},created:function(){var e=this;this.componentKeys=p.a.map(u["a"],(function(e,t){return{label:t,value:t}})),this.initCreateData(),this.$watch("model",(function(){if(e.isEdit=e.model&&e.model.id>0,e.isEdit){var t=[];e.model.roles.forEach((function(e){t.push(e.id)})),e.model.roles=t;var r=[];e.model.permissions.forEach((function(e){r.push(e.id.toString())})),e.targetKeys=r}e.model&&e.form.setFieldsValue(s()(e.model,f))}))},methods:{initCreateData:function(){var e=this;return Object(o["a"])(regeneratorRuntime.mark((function t(){var r,a;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,Object(d["b"])();case 2:r=t.sent,a=r.data,e.permissionData=a.permissions.map((function(e){return{key:e.id.toString(),title:e.name}})),e.roleData=a.roles.map((function(e){return{label:e.name,value:e.id}})),e.treeData=a.parent_tree;case 7:case"end":return t.stop()}}),t)})))()},handleChange:function(e,t,r){this.targetKeys=e},handleIconChange:function(e){this.form.setFieldsValue({icon:e})}}},b=v,w=(r("6036"),r("2877")),g=Object(w["a"])(b,a,n,!1,null,"bffe0dfe",null);t["default"]=g.exports},"1da1":function(e,t,r){"use strict";r.d(t,"a",(function(){return n}));r("d3b7"),r("e6cf");function a(e,t,r,a,n,o,i){try{var s=e[o](i),c=s.value}catch(l){return void r(l)}s.done?t(c):Promise.resolve(c).then(a,n)}function n(e){return function(){var t=this,r=arguments;return new Promise((function(n,o){var i=e.apply(t,r);function s(e){a(i,n,o,s,c,"next",e)}function c(e){a(i,n,o,s,c,"throw",e)}s(void 0)}))}}},6036:function(e,t,r){"use strict";var a=r("f6db"),n=r.n(a);n.a},"8da9":function(e,t,r){"use strict";r.d(t,"c",(function(){return n})),r.d(t,"b",(function(){return o})),r.d(t,"a",(function(){return i})),r.d(t,"d",(function(){return s}));var a=r("b775");function n(e){return Object(a["b"])({url:"/admin-menus",method:"get",params:e})}function o(){return Object(a["b"])({url:"/admin-menus/create",method:"get"})}function i(e){return Object(a["b"])({url:"/admin-menus",method:"post",data:e})}function s(e,t){return Object(a["b"])({url:"/admin-menus/".concat(e),method:"put",data:t})}},f6db:function(e,t,r){}}]);