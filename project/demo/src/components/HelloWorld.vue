<template>
  <div class="hello">
     <div class="layout">
        <Layout>
            <Sider breakpoint="md" collapsible :collapsed-width="78" v-model="isCollapsed">
                <Menu active-name="1-1" theme="dark" width="auto" :class="menuitemClasses">
                    <MenuItem name="1-1"  @click.native='select(1)' >
                        <Icon type="ios-navigate"></Icon>
                        <span>每日一笑</span>
                    </MenuItem>
                    <MenuItem name="1-2"  @click.native='select(2)' >
                        <Icon type="ios-search"></Icon>
                        <span>每日一听</span>
                    </MenuItem>
                    <MenuItem name="1-3"   @click.native='select(3)'>
                        <Icon type="ios-settings"></Icon>
                        <span>每日一看</span>
                    </MenuItem>
                </Menu>
                <div slot="trigger"></div>
            </Sider>
            <Layout>
                <Header class="layout-header-bar">
                  <i-button @click='openCover'>操作</i-button>
                </Header>
                <Content :style="{margin: '20px', background: '#fff', minHeight: '220px'}">
                    <div v-show='chooseType=="1"'>
                       <i-table :columns="columns1" :data="data1"></i-table>
                    </div>
                    <div v-show='chooseType=="2"'>2</div>
                    <div v-show='chooseType=="3"'>3</div>
                </Content>
            </Layout>
        </Layout>
    </div>
    <div v-if="coverShow" class="cover" @click='closeCover'>
      <div class="btn-box" @click.stop>
        <div>操作人：<i-input v-model="name"></i-input></div>
        <div>内容：<i-input v-model="content"></i-input></div>
        <div>操作时间：<i-input v-model="time"></i-input></div>
        <div class="addbtn"><i-button type='success'  @click.stop='addContent'>添加</i-button></div>
      </div>
      
    </div>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
      coverShow:false,
      name:"",
      content:"",
      time:"",
      isCollapsed: false,
      chooseType:'1',
      columns1: [
                    {
                        title: '添加人',
                        key: 'doperson'
                    },
                    {
                        title: '内容',
                        key: 'content'
                    },
                    {
                        title: '添加时间',
                        key: 'createtime'
                    }
                ],
                data1: [
                    
                ]
    }
  },
  computed: {
      menuitemClasses: function () {
          return [
              'menu-item',
              this.isCollapsed ? 'collapsed-menu' : ''
          ]
      }
  },
  methods: {
    openCover(){
      this.coverShow = true;
    },
    closeCover(){
      this.coverShow = false;
    },
    select(name){
      console.log(name)
      this.chooseType = name;
    },
    addContent(){
      console.log(111)
      // this.$http({
      //         method: 'get',
      //         data:{
      //           doperson:this.name,
      //           content :this.content ,
      //           createtime :this.time
      //         },
      //         url:"/api/before_after/dayLaugh/add.php",
      //       }).then((res)=>{
      //         console.log(res.data);
      //         // alert("添加成功");
      //       });
      var params = new URLSearchParams();
          params.append('doperson', this.name);
          params.append('content', this.content);
          params.append('createtime', this.time);
      this.$http.post('/api/before_after/dayLaugh/add.php',params)
      .then((res)=>{
        console.log(res)
        this.$http.get('/api/before_after/dayLaugh/search.php')
        .then((res)=>{
          console.log(res)
          this.data1 = res.data;
          this.coverShow = false;
          this.name = "";
          this.content = "";
          this.time = "";
        })
      })
    }
  },
  created () {
     this.$http.get('/api/before_after/dayLaugh/search.php')
      .then((res)=>{
        console.log(res)
        this.data1 = res.data;
      })
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.layout{
        border: 1px solid #d7dde4;
        background: #f5f7f9;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }
    .ivu-table th{
      text-align: center;
    }
    .layout-header-bar{
        background: #fff;
        box-shadow: 0 1px 1px rgba(0,0,0,.1);
    }
    .menu-item span{
        display: inline-block;
        overflow: hidden;
        width: 69px;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: bottom;
        transition: width .2s ease .2s;
    }
    .menu-item i{
        transform: translateX(0px);
        transition: font-size .2s ease, transform .2s ease;
        vertical-align: middle;
        font-size: 16px;
    }
    .collapsed-menu span{
        width: 0px;
        transition: width .2s ease;
    }
    .collapsed-menu i{
        transform: translateX(5px);
        transition: font-size .2s ease .2s, transform .2s ease .2s;
        vertical-align: middle;
        font-size: 22px;
    }
    .ivu-table th{
      text-align: center;
    }
    .cover{
      background: rgba(0,0,0,0.5);
      position: fixed;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      z-index: 5;
    }
    .btn-box{
      position: absolute;
      right: 0;
      width: 300px;
      height: 100%;
      top: 0; 
      background:rgba(255,255,255,0.8); 
    }
    .addbtn{
      margin-top: 20px; 
    }
    
</style>
