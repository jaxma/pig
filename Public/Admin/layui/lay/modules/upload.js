layui.define("layer",function(q){var k=layui.$,y=layui.layer,h=layui.hint(),w=layui.device(),g={config:{},set:function(c){var a=this;return a.config=k.extend({},a.config,c),a},on:function(c,a){return layui.onevent.call(this,b,c,a)}},j=function(){var a=this;return{upload:function(c){a.upload.call(a,c)},config:a.config}},b="upload",x="layui-upload-file",v="layui-upload-form",z="layui-upload-iframe",m="layui-upload-choose",d=function(c){var a=this;a.config=k.extend({},a.config,g.config,c),a.render()};d.prototype.config={accept:"images",exts:"",auto:!0,bindAction:"",url:"",field:"file",method:"post",data:{},drag:!0,size:0,multiple:!1},d.prototype.render=function(c){var a=this,c=a.config;c.elem=k(c.elem),c.bindAction=k(c.bindAction),a.file(),a.events()},d.prototype.file=function(){var c=this,a=c.config,i=c.elemFile=k(['<input class="'+x+'" type="file" name="'+a.field+'"',a.multiple?" multiple":"",">"].join("")),f=a.elem.next();(f.hasClass(x)||f.hasClass(v))&&f.remove(),w.ie&&w.ie<10&&a.elem.wrap('<div class="layui-upload-wrap"></div>'),c.isFile()?(c.elemFile=a.elem,a.field=a.elem[0].name):a.elem.after(i),w.ie&&w.ie<10&&c.initIE()},d.prototype.initIE=function(){var i=this,f=i.config,l=k('<iframe id="'+z+'" class="'+z+'" name="'+z+'" frameborder="0"></iframe>'),c=k(['<form target="'+z+'" class="'+v+'" method="'+f.method,'" key="set-mine" enctype="multipart/form-data" action="'+f.url+'">',"</form>"].join(""));k("#"+z)[0]||k("body").append(l),f.elem.next().hasClass(z)||(i.elemFile.wrap(c),f.elem.next("."+z).append(function(){var a=[];return layui.each(f.data,function(n,e){a.push('<input type="hidden" name="'+n+'" value="'+e+'">')}),a.join("")}()))},d.prototype.msg=function(a){return y.msg(a,{icon:2,shift:6})},d.prototype.isFile=function(){var a=this.config.elem[0];if(a){return"input"===a.tagName.toLocaleLowerCase()&&"file"===a.type}},d.prototype.preview=function(c){var a=this;window.FileReader&&layui.each(a.chooseFiles,function(f,e){var l=new FileReader;l.readAsDataURL(e),l.onload=function(){c&&c(f,e,this.result)}})},d.prototype.upload=function(L,B){layer.load();var a=B;var M={};var I=this;var f=false;var ispng=false;try{new File(["test"],"test");f=true}catch(L){console.log(L);layer.closeAll("loading")}$.each(this.chooseFiles,function(l,e){if(e.type.toString().indexOf("png")!=-1){ispng=true}});if(I.config.accept=="images"&&f&&!ispng){$.each(this.chooseFiles,function(l,e){var c=new FileReader();c.readAsDataURL(e);c.onload=function(o){var n=o.target.result;var r=new Image();r.src=n;r.onload=function(){var S=document.createElement("canvas");console.log(e.type);S.width=this.width;S.height=this.height;var ac=S.getContext("2d");ac.drawImage(this,0,0,S.width,S.height);var Q=S.toDataURL(e.type,0.3);var W=atob(Q.split(",")[1]);var ak=new ArrayBuffer(W.length);var Z=new Uint8Array(ak);for(var ae=0;ae<W.length;ae++){Z[ae]=W.charCodeAt(ae)}var ai=new Blob([ak],{type:"image/png"});var t=new File([ai],e.name,{type:"image/png"});a=t;M[l]=a;I.chooseFiles=M;var Y,X=I,ad=X.config,V=X.elemFile[0],U=function(){layui.each(L||X.files||X.chooseFiles||V.files,function(F,u){var ab=new FormData;ae=layui.$;ab.append(ad.field,a),layui.each(ad.data,function(am,al){ab.append(am,al)}),ae.ajax({url:ad.url,type:ad.method,data:ab,async:false,contentType:!1,processData:!1,dataType:"json",success:function(al){ah(F,al)},error:function(){X.msg("请求上传接口出现异常"),aa(F)}})})},aj=function(){var u=ae("#"+z);X.elemFile.parent().submit(),clearInterval(d.timer),d.timer=setInterval(function(){var ab,F=u.contents().find("body");try{ab=F.text()}catch(al){X.msg("获取上传后的响应信息出现异常"),clearInterval(d.timer),aa()}ab&&(clearInterval(d.timer),F.html(""),ah(0,ab))},30)},ah=function(ab,F){if(X.elemFile.next("."+m).remove(),V.value="","object"!=typeof F){try{F=JSON.parse(F)}catch(u){return F={},X.msg("请对上传接口返回有效JSON")}}"function"==typeof ad.done&&ad.done(F,ab||0,function(al){X.upload(al)})},aa=function(u){ad.auto&&(V.value=""),"function"==typeof ad.error&&ad.error(u||0,function(F){X.upload(F)})},R=ad.exts,af=function(){var u=[];return layui.each(L||X.chooseFiles,function(ab,F){u.push(F.name)}),u}(),ag={preview:function(u){X.preview(u)},upload:function(ab,F){var u={};u[ab]=F,X.upload(u)},pushFile:function(){return X.files=X.files||{},layui.each(X.chooseFiles,function(F,u){X.files[F]=u}),X.files}},P=function(){return"choose"===e?ad.choose&&ad.choose(ag):(ad.before&&ad.before(ag),w.ie?w.ie>9?U():aj():void U())};switch(af=0===af.length?V.value.match(/[^\/\\]+\..+/g)||[]||"":af,ad.accept){case"file":if(R&&!RegExp("\\w\\.("+R+")$","i").test(escape(af))){return X.msg("选择的文件中包含不支持的格式"),V.value=""}break;case"video":if(!RegExp("\\w\\.("+(R||"avi|mp4|wma|rmvb|rm|flash|3gp|flv")+")$","i").test(escape(af))){return X.msg("选择的视频中包含不支持的格式"),V.value=""}break;case"audio":if(!RegExp("\\w\\.("+(R||"mp3|wav|mid")+")$","i").test(escape(af))){return X.msg("选择的音频中包含不支持的格式"),V.value=""}break;default:if(layui.each(af,function(F,u){RegExp("\\w\\.("+(R||"jpg|png|gif|bmp|jpeg$")+")","i").test(escape(u))||(Y=!0)}),Y){return X.msg("选择的图片中包含不支持的格式"),V.value=""}}if(ad.size>0&&!(w.ie&&w.ie<10)){var T;if(layui.each(X.chooseFiles,function(ab,F){if(F.size>1024*ad.size){var u=ad.size/1024;u=u>=1?Math.floor(u)+(u%1>0?u.toFixed(1):0)+"MB":ad.size+"KB",V.value="",T=u}}),T){return X.msg("文件不能超过"+T)}}P()}}})}else{var E,D=this,H=D.config,C=D.elemFile[0],A=function(){layui.each(L||D.files||D.chooseFiles||C.files,function(l,c){var o=new FormData;o.append(H.field,c),layui.each(H.data,function(r,n){o.append(r,n)}),k.ajax({url:H.url,type:H.method,data:o,contentType:!1,processData:!1,dataType:"json",success:function(e){N(l,e)},error:function(){D.msg("请求上传接口出现异常"),G(l)}})})},O=function(){var c=k("#"+z);D.elemFile.parent().submit(),clearInterval(d.timer),d.timer=setInterval(function(){var l,e=c.contents().find("body");try{l=e.text()}catch(o){D.msg("获取上传后的响应信息出现异常"),clearInterval(d.timer),G()}l&&(clearInterval(d.timer),e.html(""),N(0,l))},30)},N=function(n,l){if(D.elemFile.next("."+m).remove(),C.value="","object"!=typeof l){try{l=JSON.parse(l)}catch(c){return l={},D.msg("请对上传接口返回有效JSON")}}"function"==typeof H.done&&H.done(l,n||0,function(o){D.upload(o)})},G=function(c){H.auto&&(C.value=""),"function"==typeof H.error&&H.error(c||0,function(l){D.upload(l)})},p=H.exts,J=function(){var c=[];return layui.each(L||D.chooseFiles,function(n,l){c.push(l.name)}),c}(),K={preview:function(c){D.preview(c)},upload:function(n,l){var c={};c[n]=l,D.upload(c)},pushFile:function(){return D.files=D.files||{},layui.each(D.chooseFiles,function(l,c){D.files[l]=c}),D.files}},i=function(){return"choose"===B?H.choose&&H.choose(K):(H.before&&H.before(K),w.ie?w.ie>9?A():O():void A())};switch(J=0===J.length?C.value.match(/[^\/\\]+\..+/g)||[]||"":J,H.accept){case"file":if(p&&!RegExp("\\w\\.("+p+")$","i").test(escape(J))){layer.closeAll("loading");return D.msg("选择的文件中包含不支持的格式"),C.value=""}break;case"video":if(!RegExp("\\w\\.("+(p||"avi|mp4|wma|rmvb|rm|flash|3gp|flv")+")$","i").test(escape(J))){layer.closeAll("loading");return D.msg("选择的视频中包含不支持的格式"),C.value=""}break;case"audio":if(!RegExp("\\w\\.("+(p||"mp3|wav|mid")+")$","i").test(escape(J))){layer.closeAll("loading");return D.msg("选择的音频中包含不支持的格式"),C.value=""}break;default:if(layui.each(J,function(l,c){RegExp("\\w\\.("+(p||"jpg|png|gif|bmp|jpeg$")+")","i").test(escape(c))||(E=!0)}),E){layer.closeAll("loading");return D.msg("选择的图片中包含不支持的格式"),C.value=""}}if(H.size>0&&!(w.ie&&w.ie<10)){var s;if(layui.each(D.chooseFiles,function(n,l){if(l.size>1024*H.size){var c=H.size/1024;c=c>=1?Math.floor(c)+(c%1>0?c.toFixed(1):0)+"MB":H.size+"KB",C.value="",s=c}}),s){return D.msg("文件不能超过"+s)}}i()}},d.prototype.events=function(){var f=this,c=f.config,i=function(e){f.chooseFiles={},layui.each(e,function(o,l){var p=(new Date).getTime();f.chooseFiles[p+"-"+o]=l})},a=function(l,r){var e=f.elemFile,p=l.length>1?l.length+"个文件":(l[0]||{}).name||e[0].value.match(/[^\/\\]+\..+/g)||[]||"";e.next().hasClass(m)&&e.next().remove(),f.upload(null,"choose"),f.isFile()||c.choose||e.after('<span class="layui-inline '+m+'">'+p+"</span>")};c.elem.off("upload.start").on("upload.start",function(){var n=k(this),p=n.attr("lay-data");if(p){try{p=new Function("return "+p)(),f.config=k.extend({},c,p)}catch(e){h.error("Upload element property lay-data configuration item has a syntax error: "+p)}}f.config.item=n,f.elemFile[0].click()}),w.ie&&w.ie<10||c.elem.off("upload.over").on("upload.over",function(){var l=k(this);l.attr("lay-over","")}).off("upload.leave").on("upload.leave",function(){var l=k(this);l.removeAttr("lay-over")}).off("upload.drop").on("upload.drop",function(p,e){var o=k(this),l=e.originalEvent.dataTransfer.files||[];o.removeAttr("lay-over"),i(l),c.auto?f.upload(l):a(l)}),f.elemFile.off("upload.change").on("upload.change",function(){var e=this.files||[];i(e),c.auto?f.upload():a(e)}),c.bindAction.off("upload.action").on("upload.action",function(){f.upload()}),c.elem.data("haveEvents")||(f.elemFile.on("change",function(){k(this).trigger("upload.change")}),c.elem.on("click",function(){f.isFile()||k(this).trigger("upload.start")}),c.drag&&c.elem.on("dragover",function(l){l.preventDefault(),k(this).trigger("upload.over")}).on("dragleave",function(l){k(this).trigger("upload.leave")}).on("drop",function(l){l.preventDefault(),k(this).trigger("upload.drop",l)}),c.bindAction.on("click",function(){k(this).trigger("upload.action")}),c.elem.data("haveEvents",!0))},g.render=function(c){var a=new d(c);return j.call(a)},q(b,g)});