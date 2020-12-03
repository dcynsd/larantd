(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-89012f3e"],{"1b7e":function(e,t,a){},"1da1":function(e,t,a){"use strict";a.d(t,"a",(function(){return n}));a("d3b7"),a("e6cf");function r(e,t,a,r,n,i,s){try{var o=e[i](s),d=o.value}catch(c){return void a(c)}o.done?t(d):Promise.resolve(d).then(r,n)}function n(e){return function(){var t=this,a=arguments;return new Promise((function(n,i){var s=e.apply(t,a);function o(e){r(s,n,i,o,d,"next",e)}function d(e){r(s,n,i,o,d,"throw",e)}o(void 0)}))}}},4672:function(e,t,a){"use strict";a.d(t,"a",(function(){return n}));var r=a("b775");function n(e){return Object(r["b"])({url:"/file-systems",method:"post",data:e})}},"4a68":function(e,t,a){"use strict";a.r(t);var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("a-modal",{attrs:{title:(e.isEdit?"编辑":"新增")+"管理员",width:1e3,visible:e.visible,"confirm-loading":e.loading},on:{ok:function(){e.$emit("ok")},cancel:function(){e.$emit("cancel")}}},[a("a-spin",{attrs:{spinning:e.loading}},[a("a-form",e._b({attrs:{form:e.form}},"a-form",e.formLayout,!1),[a("a-form-item",{directives:[{name:"show",rawName:"v-show",value:e.isEdit,expression:"isEdit"}],attrs:{label:"主键ID"}},[a("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["id",{initialValue:0}],expression:"['id', { initialValue: 0 }]"}],attrs:{disabled:""}})],1),a("a-form-item",{attrs:{label:"名称"}},[a("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["name",{rules:[{required:!0,min:1,message:"请输入至少一个字符的名称！"}]}],expression:"['name', {rules: [{required: true, min: 1, message: '请输入至少一个字符的名称！'}]}]"}]})],1),a("a-form-item",{attrs:{label:"账号"}},[a("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["username",{rules:[{required:!0,min:1,message:"请输入至少一个字符的账号！"}]}],expression:"['username', {rules: [{required: true, min: 1, message: '请输入至少一个字符的账号！'}]}]"}]})],1),a("a-form-item",{attrs:{label:"头像"}},[a("upload",{directives:[{name:"decorator",rawName:"v-decorator",value:["avatar"],expression:"['avatar']"}],attrs:{max:1,folder:"avatars",list:e.fileList},on:{ok:e.handleUploadOk}})],1),a("a-form-item",{attrs:{label:"密码"}},[a("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["password",{rules:[{required:!e.isEdit,min:5,message:"请输入至少五个字符的密码！"},{validator:e.validateToNextPassword}]}],expression:"[\n            'password',\n            {\n              rules: [\n                {required: isEdit ? false: true, min: 5, message: '请输入至少五个字符的密码！'},\n                {\n                  validator: validateToNextPassword,\n                },\n              ]\n            }\n          ]"}],attrs:{type:"password"}})],1),a("a-form-item",{attrs:{label:"确认密码"}},[a("a-input",{directives:[{name:"decorator",rawName:"v-decorator",value:["password_confirmation",{rules:[{required:!e.isEdit,message:"请再次输入密码"},{validator:e.compareToFirstPassword}]}],expression:"[\n            'password_confirmation',\n            {\n              rules: [\n                {required: isEdit ? false : true, message: '请再次输入密码'},\n                {\n                  validator: compareToFirstPassword,\n                },\n              ]\n            }\n          ]"}],attrs:{type:"password"}})],1),a("a-form-item",{attrs:{label:"角色"}},[a("a-select",{directives:[{name:"decorator",rawName:"v-decorator",value:["roles",{rules:[{required:!0,message:"请选择至少一个角色",type:"array"}]}],expression:"[\n            'roles',\n            {\n              rules: [\n                { required: true, message: '请选择至少一个角色', type: 'array' },\n              ],\n            },\n          ]"}],attrs:{mode:"multiple",placeholder:"请选择角色",options:e.roleData}})],1),a("a-form-item",{attrs:{label:"权限"}},[a("a-transfer",{directives:[{name:"decorator",rawName:"v-decorator",value:["permissions"],expression:"['permissions']"}],attrs:{titles:["待选","已选"],"data-source":e.permissionData,"target-keys":e.targetKeys,"show-search":"",render:function(e){return e.title}},on:{change:e.handleChange}})],1)],1)],1)],1)},n=[],i=(a("4160"),a("d81d"),a("b0c0"),a("d3b7"),a("25f0"),a("159b"),a("96cf"),a("1da1")),s=a("88bc"),o=a.n(s),d=a("aba1"),c=a("5e30"),l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"clearfix"},[a("a-upload",{attrs:{"list-type":"picture-card","file-list":e.fileList,customRequest:e.customRequest},on:{preview:e.handlePreview,change:e.handleChange}},[e.fileList.length<e.max?a("div",[a("a-icon",{attrs:{type:"plus"}}),a("div",{staticClass:"ant-upload-text"},[e._v(" 点击上传 ")])],1):e._e()]),a("a-modal",{attrs:{visible:e.previewVisible,footer:null},on:{cancel:e.handleCancel}},[a("img",{staticStyle:{width:"100%"},attrs:{alt:"example",src:e.previewImage}})])],1)},u=[],m=(a("a9e3"),a("4672"));function f(e){return new Promise((function(t,a){var r=new FileReader;r.readAsDataURL(e),r.onload=function(){return t(r.result)},r.onerror=function(e){return a(e)}}))}var h={props:{max:{type:Number,default:7},folder:{type:String,default:"common"},list:{type:Array,default:function(){return[]}}},data:function(){return{previewVisible:!1,previewImage:"",fileList:[]}},watch:{list:function(e){this.fileList=e}},created:function(){this.fileList=this.list},methods:{handleCancel:function(){this.previewVisible=!1},handlePreview:function(e){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function a(){return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:if(e.url||e.preview){a.next=4;break}return a.next=3,f(e.originFileObj);case 3:e.preview=a.sent;case 4:t.previewImage=e.url||e.preview,t.previewVisible=!0;case 6:case"end":return a.stop()}}),a)})))()},handleChange:function(e){var t=e.fileList;this.fileList=t},customRequest:function(e){var t=this;return Object(i["a"])(regeneratorRuntime.mark((function a(){var r,n;return regeneratorRuntime.wrap((function(a){while(1)switch(a.prev=a.next){case 0:return r=new FormData,r.append("file",e.file),r.append("folder",t.folder),e.onProgress(),a.next=6,Object(m["a"])(r);case 6:n=a.sent,200===n.code?e.onSuccess():e.onError(),t.$emit("ok",{path:n.data.path});case 9:case"end":return a.stop()}}),a)})))()}}},p=h,v=(a("4aa1"),a("2877")),g=Object(v["a"])(p,l,u,!1,null,null,null),w=g.exports,b=["id","name","username","avatar","password","password_confirmation","roles","permissions"],y=new d["a"]({fields:b}),x={mixins:[y],components:{Upload:w},data:function(){return{permissionData:[],targetKeys:[],roleData:[],fileList:[]}},created:function(){var e=this;this.initCreateData(),b.forEach((function(t){return e.form.getFieldDecorator(t)})),this.$watch("model",(function(){if(e.targetKeys=[],e.fileList=[],e.isEdit=e.model&&e.model.id>0,e.isEdit){var t=[],a=[];e.model.permissions.forEach((function(e){t.push(e.id.toString())})),e.targetKeys=t,e.model.roles.forEach((function(e){a.push(e.id)})),e.model.roles=a,e.fileList.push({uid:"-1",name:"avatar.png",status:"done",url:e.model.full_avatar})}e.model&&e.form.setFieldsValue(o()(e.model,b))}))},methods:{initCreateData:function(){var e=this;return Object(i["a"])(regeneratorRuntime.mark((function t(){var a,r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:return t.next=2,Object(c["b"])();case 2:a=t.sent,r=a.data,e.permissionData=r.permissions.map((function(e){return{key:e.id.toString(),title:e.name}})),e.roleData=r.roles.map((function(e){return{label:e.name,value:e.id}}));case 6:case"end":return t.stop()}}),t)})))()},handleChange:function(e,t,a){this.targetKeys=e},validateToNextPassword:function(e,t,a){var r=this.form;t&&this.confirmDirty&&r.validateFields(["password_confirmation"],{force:!0}),a()},compareToFirstPassword:function(e,t,a){var r=this.form;t&&t!==r.getFieldValue("password")?a("两次输入密码不一致"):a()},handleUploadOk:function(e){this.form.setFieldsValue({avatar:e.path})}}},k=x,R=(a("d3c7"),Object(v["a"])(k,r,n,!1,null,"0a4a7578",null));t["default"]=R.exports},"4aa1":function(e,t,a){"use strict";var r=a("1b7e"),n=a.n(r);n.a},"5e30":function(e,t,a){"use strict";a.d(t,"c",(function(){return n})),a.d(t,"b",(function(){return i})),a.d(t,"a",(function(){return s})),a.d(t,"d",(function(){return o}));var r=a("b775");function n(e){return Object(r["b"])({url:"/admin-users",method:"get",params:e})}function i(){return Object(r["b"])({url:"/admin-users/create",method:"get"})}function s(e){return Object(r["b"])({url:"/admin-users",method:"post",data:e})}function o(e,t){return Object(r["b"])({url:"/admin-users/".concat(e),method:"put",data:t})}},"61e9":function(e,t,a){"use strict";a("4160"),a("b0c0"),a("159b");var r=a("ade3"),n=a("5530"),i=a("2ef0e"),s=a.n(i),o=a("b775");function d(e,t){return Object(o["b"])({url:"/".concat(e,"/batch"),method:"delete",data:t})}t["a"]=function(e){var t=e.getList,a=e.add,i=e.update;return{provide:function(){return{handleFilter:this.handleFilter,handleCreate:this.handleCreate,toggleAdvanced:this.toggleAdvanced,resetSearchForm:this.resetSearchForm,batchDestroy:this.batchDestroy}},data:function(){var e=this;return{resourceName:"",visible:!1,confirmLoading:!1,mdl:null,advanced:!1,queryParam:{},options:{},meta:{},loadData:function(a){return t(Object.assign({},a,e.queryParam)).then((function(t){return e.meta=t.data.meta,t.data}))},selectedRowKeys:[],selectedRows:[]}},computed:{rowSelection:function(){return{selectedRowKeys:this.selectedRowKeys,onChange:this.onSelectChange,getCheckboxProps:this.getCheckboxProps}}},methods:{onSelectChange:function(e,t){this.selectedRowKeys=e,this.selectedRows=t},getCheckboxProps:function(e){return{props:{name:e.name}}},batchDestroy:function(){var e=this;this.resourceName?0!==this.selectedRowKeys.length?this.$confirm({title:"你确定要批量删除数据？",okText:"确定",okType:"danger",cancelText:"取消",onOk:function(){return d(e.resourceName,{ids:e.selectedRowKeys}).then((function(){e.$message.success("删除成功"),e.selectedRowKeys=[],e.selectedRows=e.$refs.table.refresh(!0)})).catch((function(){e.$message.error("删除失败")}))}}):this.$message.error("请选择"):this.$message.error("请配置资源名称")},toggleAdvanced:function(){this.advanced=!this.advanced},handleFilter:function(){this.$refs.table.refresh(!0)},resetSearchForm:function(){this.queryParam={},this.$refs.table.refresh(!0)},handleCreate:function(){this.mdl=null,this.visible=!0},handleEdit:function(e){this.visible=!0,this.mdl=Object(n["a"])({},e)},handleCancel:function(){this.visible=!1;var e=this.$refs.createModal.form;e.resetFields()},handleOk:function(){var e=this,t=this.$refs.createModal.form;this.confirmLoading=!0,t.validateFields((function(n,o){n?e.confirmLoading=!1:o.id>0?i(o.id,o).then((function(){e.visible=!1,e.confirmLoading=!1,t.resetFields(),e.$refs.table.refresh(),e.$message.success("修改成功")})).catch((function(a){var n=a.response.data,i=n.code,d=n.error;422===i&&s.a.forEach(d,(function(e,a){t.setFields(Object(r["a"])({},a,{value:o[a],errors:[{message:e[0],field:a}]}))})),e.confirmLoading=!1})):a(o).then((function(){e.visible=!1,e.confirmLoading=!1,t.resetFields(),e.$refs.table.refresh(),e.$message.success("新增成功")})).catch((function(a){var n=a.response.data,i=n.code,d=n.error;422===i&&s.a.forEach(d,(function(e,a){t.setFields(Object(r["a"])({},a,{value:o[a],errors:[{message:e[0],field:a}]}))})),e.confirmLoading=!1}))}))}}}}},"9d53":function(e,t,a){},b937:function(e,t,a){"use strict";a.r(t);var r=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("page-header-wrapper",[a("a-card",{attrs:{bordered:!1}},[a("page-filter",{attrs:{"query-param":e.queryParam,advanced:e.advanced,filters:e.filters}}),a("s-table",{ref:"table",attrs:{"row-key":"id",columns:e.columns,data:e.loadData},scopedSlots:e._u([{key:"expandedRowRender",fn:function(t){return a("div",{staticStyle:{margin:"0"}},[a("a-row",{style:{marginBottom:"12px"},attrs:{gutter:24}},[a("a-col",{attrs:{lg:2,md:24}},[a("span",[e._v("角色：")])]),e._l(t.roles,(function(t){return a("a-col",{key:t.id,style:{marginBottom:"12px",height:"23px"},attrs:{span:2}},[a("a-tag",{attrs:{color:"cyan"}},[e._v(e._s(t.name))])],1)}))],2),a("a-row",{style:{marginBottom:"12px"},attrs:{gutter:24}},[a("a-col",{attrs:{lg:2,md:24}},[a("span",[e._v("权限：")])]),e._l(t.permissions,(function(t){return a("a-col",{key:t.id,style:{marginBottom:"12px",height:"23px"},attrs:{span:2}},[a("a-tag",{attrs:{color:"cyan"}},[e._v(e._s(t.name))])],1)}))],2)],1)}},{key:"avatar",fn:function(e,t){return a("span",{directives:[{name:"viewer",rawName:"v-viewer"}]},[a("a-avatar",{attrs:{src:t.full_avatar}})],1)}},{key:"action",fn:function(t,r){return a("span",{},[1===r.id?a("a",{attrs:{disabled:""}},[e._v("禁止操作")]):a("span",[a("a",{on:{click:function(t){return e.handleEdit(r)}}},[e._v("编辑")]),a("a-divider",{attrs:{type:"vertical"}}),a("row-destroy",{attrs:{id:r.id,resource:e.resourceName},on:{ok:e.handleFilter}})],1)])}}])}),a("create-form",{ref:"createModal",attrs:{visible:e.visible,loading:e.confirmLoading,model:e.mdl},on:{cancel:e.handleCancel,ok:e.handleOk}})],1)],1)},n=[],i=(a("4de4"),a("5e30")),s=a("61e9"),o=a("4a68"),d=new s["a"]({getList:i["c"],add:i["a"],update:i["d"]}),c={name:"UserList",mixins:[d],components:{CreateForm:o["default"]},data:function(){return{resourceName:"admin-users",columns:[{title:"ID",dataIndex:"id"},{title:"名称",dataIndex:"name"},{title:"账号",dataIndex:"username"},{title:"头像",dataIndex:"avatar",scopedSlots:{customRender:"avatar"}},{title:"创建时间",dataIndex:"created_at"},{title:"更新时间",dataIndex:"updated_at"},{title:"操作",dataIndex:"action",width:"150px",scopedSlots:{customRender:"action"}}],filters:[{field:"name",advanced:!1,label:"名称",type:"input"},{field:"username",advanced:!1,label:"账号",type:"input"}],expandedRowKeys:[]}},methods:{handleExpand:function(e,t){e?this.expandedRowKeys.push(t.id):this.expandedRowKeys=this.expandedRowKeys.filter((function(e){return t.id!==e}))}}},l=c,u=a("2877"),m=Object(u["a"])(l,r,n,!1,null,null,null);t["default"]=m.exports},d3c7:function(e,t,a){"use strict";var r=a("9d53"),n=a.n(r);n.a}}]);