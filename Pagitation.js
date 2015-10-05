var Paginate = (function(){
  var set = {
    list:{}
  }

  set.create = function(o){
    if(typeof set.list[o.name]=='undefined'){
      set.list[o.name] = {
        n:0,
        controller:o.name+'/paginate'
      }
      set.list[o.name].template = Handlebars.compile( $('.paginate-item-'+o.name).html() )
      set.list[o.name].box = $( '.paginate-box-'+o.name )
      set.bindMoreBtn(o.name)
    }
    set.list[o.name].limit = typeof o.limit != 'undefined' ? o.limit : 3
    if(typeof o.init != 'undefined') set.getData(o.name)
  }

  set.bindMoreBtn = function(n){
    $('.paginate-btn-'+n).click(function(){
      Paginate.getData(n)
    })
  }
 
set.getData = function(){ 
  $.ajax({
    type:'post',
    async:1,
    data:data:{n:set.list[n].n, limit: set.list[n].limit},
    url:set.list[n].controller,
    success: function(d){
      // parse response to valid JSON
      d = JSON.parse(d)
      // render of it
      set.renderData(n,d)
      // increment paginate iterator
      set.list[n].n++
    }
  })
}

 /* render item */
  set.renderData = function(n,d){
    $.each(d,function(k,v){
      set.renderItem(n,v)
    })
  }

  return set

})()
