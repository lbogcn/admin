define(["vue","jquery","datetimepicker","datetimepicker-lang"],function(e,t){e.component("vue-datetime-picker",{template:'<input :class="cls" v-model="val" type="text" readonly>',data:function(){return{val:""}},props:["cls","value"],watch:{val:function(e){this.$emit("update:value",e)}},mounted:function(){var e=this;this.val=this.value,t(this.$el).datetimepicker({format:"yyyy-mm-dd",language:"zh-CN",minView:2,maxView:"year",autoclose:!0,todayBtn:!0,todayHighlight:!0,weekStart:0}).on("changeDate",function(t){e.val=t.target.value})}})});