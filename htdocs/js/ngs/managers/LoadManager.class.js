ngs.LoadManager={
	
  init: function(){
  
   	
  },
  
  start: function(loadFactory){
  	this.loadFactory = loadFactory;
  	this.initLoads();
  },
  
  initLoads: function(){
  
  },
  
  setLoad: function(load){
    	var method = load.getMethod();
  	if(method.toUpperCase() == "POST"){
  		return;
  	}  	
  	
	
	  
  },
  
  onUrlChange: function(oldLocation, location){
  	var loadObj = this.toObject(location);
  	this.runLoads(loadObj);  	  	
  },
  
  runLoads: function(objs){
  	if(!objs){
  		return;
  	}
  	for(var i = 0; i< objs.length; i++){
  		var obj = objs[i];
	  	var load = this.loadFactory.getLoad(obj.s);
	  	load.setParams(obj.p);
	  	load.load();
	  	if(obj.a && obj.a.length > 0){
	  		this.runLoads(obj.a);
	  	}
	  }
  },
		
	computeObject: function(objs){
		if(!objs){
  		return [];
  	}
  	var newObjs = [];
  	for(var i = 0; i< objs.length; i++){
  		var obji = objs[i];
  		var load = this.loadFactory.getLoad(obji.s);
	  	load.setParams(obji.p);
  		var obj = {
									elem: $(load.getContainer()),
									elems: [],
									load: load
								};
  		
	  	if(obji.a && obji.a.length > 0){
	  		obj.elems = this.computeObject(obji.a);
	  	}
	  	newObjs.push(obj);
	  }
	  return newObjs;
	},
	
	createObj: function(load){
		var obj = {
								elem: $(load.getContainer()),
								elems: [],
								load: load
							};
		
		return obj;
	}
};

//[{s:short1,p:[param:value],a:[{s:short2,p:[param:value],{s:short1,p:[param:value],a:[short2]}]